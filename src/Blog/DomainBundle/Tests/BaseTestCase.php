<?php

namespace Blog\DomainBundle\Tests;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    private $environment;

    private $entityFixtureManager;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->environment = TestsEnvironment::getInstance();
        $this->environment->runSilent(true);
        $this->environment->addCommand("doctrine:schema:drop", array("--force" => true));
        $this->environment->addCommand("doctrine:schema:create", array());
        $this->environment->addCommand("cache:warmup", array(), true);
        $this->environment->addCommand("doctrine:fixtures:load", array("--fixtures" => __DIR__ . "/DataFixtures"));
        $this->environment->runCommands();
    }

    /**
     * Returns IoC container
     *
     * @param string $service
     * @return object
     */
    protected function get($service)
    {
        return $this->environment->getContainer()->get($service);
    }

    protected function getEntityFixtureManager()
    {
        if ($this->entityFixtureManager === null) {
            /** @var $queryFactory \Blog\DomainBundle\Doctrine\QueryFactory */
            $queryFactory = $this->get("domain.doctrine.queryFactory");
            $this->entityFixtureManager = new EntityFixtureManager($queryFactory);
        }
        return $this->entityFixtureManager;
    }
}

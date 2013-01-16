<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Infrastructure\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Monolog\Logger;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestsEnvironment
     */
    private $environment;

    /**
     * @var EntityFixtureManager
     */
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

    /**
     * Returns entity fixture manager
     *
     * @return EntityFixtureManager
     */
    protected function getEntityFixtureManager()
    {
        if ($this->entityFixtureManager === null) {
            $this->entityFixtureManager = new EntityFixtureManager($this->getQueryFactory(), $this->getDoctrine());
        }
        return $this->entityFixtureManager;
    }

    /**
     * Returns query factory
     *
     * @return \Blog\DomainBundle\Doctrine\QueryFactory
     */
    protected function getQueryFactory()
    {
        $queryFactory = $this->get('blog.domain.doctrine.queryFactory');

        return $queryFactory;
    }

    /**
     * Returns doctrine
     *
     * @return Registry
     */
    protected function getDoctrine()
    {
        return $this->get('doctrine');
    }

    /**
     * Returns logger
     *
     * @return Logger
     */
    protected function getLogger()
    {
        return new Logger('test');
    }

	/**
	 * Returns base repository
	 *
	 * @param string $entityName
	 * @return BaseRepository
	 */
	protected function getRepository($entityName)
	{
		return $this->getDoctrine()->getRepository('BlogDomainBundle:' . $entityName);
	}
}

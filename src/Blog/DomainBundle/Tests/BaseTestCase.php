<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Tests\Utils\TestsEnvironment;
use Monolog\Logger;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestsEnvironment
     */
    private $environment;

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
}

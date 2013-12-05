<?php

namespace Blog\DomainBundle\Tests;

use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\DomainBundle\Tests\Utils\TestsEnvironment;

class IntegrationTestCaseBase extends TestCaseBase
{
	/**
	 * @inheritdoc
	 */
	public static function setUpBeforeClass()
	{
		self::getEnvironment()
			->setSilent(true)
			->addCommand("doctrine:schema:drop", array("--force" => true))
			->addCommand("doctrine:schema:create", array())
			->addCommand("cache:warmup", array(), true)
			->addCommand("doctrine:fixtures:load", array("--fixtures" => __DIR__ . "/DataFixtures"))
			->runCommands();
	}

	/**
	 * Returns IoC container
	 *
	 * @param string $service
	 * @return object
	 */
	protected function get($service)
	{
		return self::getEnvironment()->getContainer()->get($service);
	}

	/**
	 * Returns repository
	 *
	 * @param $entityName
	 * @return IRepository
	 */
	protected function getRepository($entityName)
	{
		return $this->get(sprintf("blog.domain.repository.%s", strtolower($entityName)));
	}

	/**
	 * Returns test environment util
	 *
	 * @return TestsEnvironment
	 */
	private static function getEnvironment()
	{
		static $environment;
		return $environment ?: $environment = new TestsEnvironment();
	}
}

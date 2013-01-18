<?php

namespace Blog\DomainBundle\Tests\Utils;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\ConsoleOutput;

class TestsEnvironment
{
	private $commands = array();
	private $kernel;
	private $application;
	private $runSilent;
	private $output;

	/**
	 * @return TestsEnvironment
	 */
	public static function getInstance()
	{
		static $instance;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}

	private function __construct()
	{
		$this->kernel = $this->buildKernel();
		$this->application = $this->buildApplication($this->kernel);
		$this->runSilent(true);
	}

	public function getContainer()
	{
		return $this->kernel->getContainer();
	}

	public function addCommand($command, array $options = array(), $once = false)
	{
		$commandId = md5($command . implode('', $options) . intval($once));

		if (array_key_exists($commandId, $this->commands)) {
			return;
		}

		$this->commands[$commandId] = array(
			'options' => array_merge(array('command' => $command), $options),
			'once' => $once,
			'runCount' => 0,
		);
	}

	public function runCommands()
	{
		foreach ($this->commands AS &$command) {
			if ($command['once'] && $command['runCount'] > 0) {
				continue;
			}

			$input = new ArrayInput($command['options']);
			$input->setInteractive(false);

			$this->application->run($input, $this->output);

			$command['runCount']++;
		}
	}

	private function buildKernel()
	{
		require_once __DIR__ . "/../../../../../app/AppKernel.php";
		$kernel = new \AppKernel("test", true);
		$kernel->boot();
		return $kernel;
	}

	private function buildApplication(\AppKernel $kernel)
	{
		$application = new Application($kernel);
		$application->setAutoExit(false);
		return $application;
	}

	public function runSilent($silent)
	{
		$this->runSilent = (bool)$silent;

		$this->output = $this->runSilent
			? new NullOutput()
			: new ConsoleOutput();
	}
}

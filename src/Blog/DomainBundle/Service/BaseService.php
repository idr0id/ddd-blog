<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Doctrine\QueryFactory;
use Blog\DomainBundle\Infrastructure\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Monolog\Logger;

abstract class BaseService
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var Logger
     */
    private $logger;

	public function __construct(Registry $doctrine, Logger $logger)
    {
        $this->doctrine = $doctrine;
        $this->logger = $logger;
    }

	/**
	 * Returns repository
	 *
	 * @param string $entityName
	 * @return BaseRepository
	 */
	protected function getRepository($entityName)
	{
		return $this->doctrine->getRepository('BlogDomainBundle:' . $entityName);
	}

    protected function persist($entity)
    {
        $this->doctrine->getManager()->persist($entity);
        return $this;
    }

    protected function flush()
    {
        $this->doctrine->getManager()->flush();
        return $this;
    }

    protected function refresh($entity)
    {
        $this->doctrine->getManager()->refresh($entity);
        return $this;
    }

    /**
     * @return \Monolog\Logger
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}

<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Doctrine\QueryFactory;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Monolog\Logger;

abstract class BaseService
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Registry $doctrine, QueryFactory $queryFactory, Logger $logger)
    {
        $this->doctrine = $doctrine;
        $this->queryFactory = $queryFactory;
        $this->logger = $logger;
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
     * @return QueryFactory
     */
    protected function getQueryFactory()
    {
        return $this->queryFactory;
    }

    /**
     * @return \Monolog\Logger
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}

<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Doctrine\QueryFactory;

class EntityFixtureManager
{
    private $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function getUser()
    {
        return $this->queryFactory->findUserByLogin('Tester');
    }
}

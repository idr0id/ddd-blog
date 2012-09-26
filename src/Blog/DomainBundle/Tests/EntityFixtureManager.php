<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Doctrine\QueryFactory;
use Doctrine\Bundle\DoctrineBundle\Registry;

class EntityFixtureManager
{
    private $queryFactory;

    public function __construct(QueryFactory $queryFactory, Registry $doctrine)
    {
        $this->queryFactory = $queryFactory;
        $this->doctrine = $doctrine;
    }

    public function getUser()
    {
        return $this->queryFactory->findUserByLogin('Tester');
    }

    public function getPostUser()
    {
        return $this->queryFactory->findUserByLogin('PostTester');
    }

    public function getAllPosts()
    {
        return $this->doctrine->getRepository('Blog\DomainBundle\Entity\Post')->findAll();
    }
}

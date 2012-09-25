<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Doctrine\QueryFactory;
use Doctrine\Bundle\DoctrineBundle\Registry;

class QueryFactoryTest extends BaseTestCase
{
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    protected function setUp()
    {
        /** @var $doctrine Registry */
        $doctrine = $this->get('doctrine');
        $this->queryFactory = new QueryFactory($doctrine);
    }

    public function testFindUserByLogin()
    {
        $user = $this->queryFactory->findUserByLogin('Tester');

        $this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
        $this->assertEquals('Tester', $user->getLogin());
    }
}

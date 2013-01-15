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
        $this->queryFactory = new QueryFactory($this->getDoctrine());
    }

    public function testFindUserByLogin()
    {
        $user = $this->queryFactory->findUserByLogin('Tester');

        $this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
        $this->assertEquals('Tester', $user->getLogin());
    }
}

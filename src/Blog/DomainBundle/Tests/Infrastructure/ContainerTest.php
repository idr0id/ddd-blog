<?php

namespace Blog\DomainBundle\Tests\Integration;

use Blog\DomainBundle\Tests\BaseTestCase;

class ContainerTest extends BaseTestCase
{
    public function testDoctrineQueryFactory()
    {
        $this->assertInstanceOf(
            'Blog\DomainBundle\Doctrine\QueryFactory',
            $this->get('blog.domain.doctrine.queryFactory')
        );
    }

    public function testServiceUser()
    {
        $this->assertInstanceOf(
            'Blog\DomainBundle\Service\UserService',
            $this->get('blog.domain.service.user')
        );
    }

    public function testServicePost()
    {
        $this->assertInstanceOf(
            'Blog\DomainBundle\Service\PostService',
            $this->get('blog.domain.service.post')
        );
    }
}

<?php

namespace Blog\DomainBundle\Tests\Entity;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Tests\EntityFactory;
use Blog\DomainBundle\Tests\BaseTestCase;

class UserTest extends BaseTestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        $this->user = EntityFactory::createUser();
    }

    public function testEqualPassword()
    {
        $this->assertTrue($this->user->checkPassword("somePassword"));
    }

    public function testChangePassword()
    {
        $this->user->changePasswordTo("changedPassword");
        $this->assertTrue($this->user->checkPassword("changedPassword"));
    }

    public function testRemovePost()
    {
        $post = new Post($this->user, 'some title', 'some text');

        $this->user->removePost($post);

        $this->assertFalse($this->user->getPosts()->contains($post));
    }
}

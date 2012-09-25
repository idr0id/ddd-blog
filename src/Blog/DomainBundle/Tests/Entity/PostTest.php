<?php

namespace Blog\DomainBundle\Tests\Entity;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Tests\EntityFactory;
use Blog\DomainBundle\Tests\BaseTestCase;

class PostTest extends BaseTestCase
{
    public function testCreatePost()
    {
        $post = EntityFactory::createPost();

        $user = $post->getAuthor();

        $this->assertEquals('It is test text', $post->getText());
        $this->assertTrue($user->getPosts()->contains($post));
    }
}

<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Entity\Post;

class EntityFactory
{
    public static function createUser()
    {
        return new User("someLogin", "somePassword");
    }

    public static function createPost()
    {
        return new Post(static::createUser(), 'It is test text');
    }
}

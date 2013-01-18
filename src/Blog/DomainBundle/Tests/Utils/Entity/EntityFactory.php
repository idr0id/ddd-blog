<?php

namespace Blog\DomainBundle\Tests\Utils\Entity;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;

class EntityFactory
{
	public static function createUser($login = 'login', $password = 'password')
	{
		return new User($login, $password);
	}

	public static function createPost(User $author = null, $title = 'title', $text = 'text')
	{
		$author = $author ? : static::createUser();
		return new Post($author, $title, $text);
	}
}

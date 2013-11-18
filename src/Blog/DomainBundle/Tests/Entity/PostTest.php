<?php

namespace Blog\DomainBundle\Tests\Entity;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Tests\TestCaseBase;

class PostTest extends TestCaseBase
{
	public function testConstruct()
	{
		// arrange
		$author = $this->createAuthor();
		// act
		$post = new Post($author, 'Title of post', 'Text of post');
		// assert
		$this->assertEquals('Title of post', $post->getTitle());
		$this->assertEquals('Text of post', $post->getText());
		$this->assertSame($author, $post->getAuthor());
		$this->assertTrue($author->getPosts()->contains($post));
	}

	private function createAuthor()
	{
		return new User('login', 'password');
	}
}

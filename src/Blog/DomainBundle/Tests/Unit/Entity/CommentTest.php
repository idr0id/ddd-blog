<?php

namespace Blog\DomainBundle\Tests\Unit\Entity;

use Blog\DomainBundle\Entity\Comment;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\TestCaseBase;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;

class CommentTest extends TestCaseBase
{
	public function testConstruct()
	{
		$author = $this->createUser();
		$post = $this->createPost($author);

		$comment = new Comment($author, $post, 'Text of the comment');

		// assert
		$this->assertSame($author, $comment->getAuthor());
		$this->assertSame($post, $comment->getPost());
		$this->assertEquals('Text of the comment', $comment->getText());
	}

	private function createUser()
	{
		return new User('login', 'password');
	}

	private function createPost(User $author)
	{
		return new Post($author, 'title', 'text');
	}
}

<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Service\CommentService;
use Blog\DomainBundle\Tests\TestCaseBase;

class CommentServiceTest extends TestCaseBase
{
	public function testCreateComment()
	{
		// arrange
		$service = $this->createCommentService();
		$author = $this->createAuthor();
		$post = $this->createPost($author);
		// act
		$comment = $service->create($author, $post, 'test');
		// assert
		$this->assertInstanceOf('Blog\\DomainBundle\\Entity\\Comment', $comment);
	}

	protected function createCommentService()
	{
		$unitOfWork = $this->getMockForAbstractClass('Blog\InfrastructureBundle\ORM\IUnitOfWork');
		return new CommentService($unitOfWork, new FakeRepository('Blog\DomainBundle\Entity\Comment', array()));
	}

	private function createAuthor()
	{
		return new User('login', 'password');
	}

	private function createPost(User $author)
	{
		return new Post($author, 'Title', 'Text');
	}
}

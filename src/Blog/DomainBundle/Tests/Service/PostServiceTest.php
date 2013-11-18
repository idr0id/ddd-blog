<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Service\PostService;
use Blog\DomainBundle\Tests\BaseTestCase;

class PostServiceTest extends BaseTestCase
{
	public function testCreate()
	{
		// arrange
		$service = $this->createPostService();
		$author = new User('login', 'password');
		// act
		$post = $service->create($author, 'Text of title', 'Text of post');
		// assert
		$this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
		$this->assertEquals('Text of title', $post->getTitle());
		$this->assertEquals('Text of post', $post->getText());
		$this->assertSame($author, $post->getAuthor());
	}

	public function testRemove()
	{
		// arrange
		$service = $this->createPostService();
		$author = $service->getPost(1)->getAuthor();
		// act
		$service->remove(1);
		// assert
		$this->assertEquals(0, $author->getPosts()->count());
	}

	public function testRemoveNonexistentShouldThrowException()
	{
		$this->setExpectedException('Blog\DomainBundle\Exception\DomainException');
		// arrange
		$service = $this->createPostService();
		// act
		$service->remove(100500);
	}

	public function testGetAllPosts()
	{
		// arrange
		$service = $this->createPostService();
		// act
		$posts = $service->getAllPosts();
		// assert
		$this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $posts);
		$this->assertContainsOnlyInstancesOf('Blog\DomainBundle\Entity\Post', $posts->getValues());
	}

	public function testGetPostById()
	{
		// arrange
		$service = $this->createPostService();
		// act
		$post = $service->getPost(1);
		// assert
		$this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
		$this->assertEquals(1, $post->getId());
	}

	private function createPostService()
	{
		$unitOfWork = $this->getMockForAbstractClass('Blog\InfrastructureBundle\ORM\IUnitOfWork');
		$repository = new FakeRepository('Blog\DomainBundle\Entity\Post', array(
			$this->createPost('title 1', 'text 1'),
			$this->createPost('title 2', 'text 2'),
			$this->createPost('title 3', 'text 3'),
		));
		return new PostService($unitOfWork, $repository);
	}

	private function createPost($title, $text)
	{
		return new Post(new User('login', 'password'), $title, $text);
	}
}

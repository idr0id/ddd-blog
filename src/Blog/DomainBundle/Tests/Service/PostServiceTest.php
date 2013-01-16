<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Infrastructure\IUnitOfWork;
use Blog\DomainBundle\Service\PostService;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\Fakes\FakeUnitOfWork;
use Blog\DomainBundle\Tests\Fakes\Repository\FakePostRepository;
use Mockery;

class PostServiceTest extends BaseTestCase
{
	/**
	 * @var PostService
	 */
	private $service;

	protected function setUp()
	{
		$this->service = new PostService(new FakeUnitOfWork(), new FakePostRepository());
	}

	public function testCreate()
	{
		$author = $this->createUser();
		$title = 'Some text of title';
		$text = 'Some text of post';

		$post = $this->service->create($author, $title, $text);

		$this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
		$this->assertInstanceOf('DateTime', $post->getCreated());
		$this->assertEquals($title, $post->getTitle());
		$this->assertEquals($text, $post->getText());
		$this->assertSame($author, $post->getAuthor());
		$this->assertTrue($author->getPosts()->contains($post));
	}

	public function testRemove()
	{
		// arrange
		$author = $this->createUser();
		$post = $this->service->create($author, 'Some text of title', 'Some text of post');
		$this->assertEquals(1, $author->getPosts()->count());

		// act
		$this->service->remove($post->getId());

		// assert
		$this->assertEquals(0, $author->getPosts()->count());
	}

	public function testRemoveNonexistentShouldThrowException()
	{
		$this->setExpectedException('Blog\DomainBundle\Exception\DomainException');

		$this->service->remove(100500);
	}

	public function testGetAllPosts()
	{
		$posts = $this->service->getAllPosts();

		$this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $posts);
		$this->assertCount(3, $posts->getValues());
	}

	public function testGetPostById()
	{
		$post = $this->service->getPost(1);

		$this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
		$this->assertEquals(1, $post->getId());
	}

	/**
	 * @return \Blog\DomainBundle\Entity\User
	 */
	private function createUser()
	{
		return new User('login', 'password');
	}
}

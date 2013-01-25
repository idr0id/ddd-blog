<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Service\PostService;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\Fakes\FakeUnitOfWork;
use Blog\DomainBundle\Tests\Fakes\Repository\FakePostRepository;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;

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
		// arrange
		$author = EntityFactory::createUser();
		$title = 'Some text of title';
		$text = 'Some text of post';

		// act
		$post = $this->service->create($author, $title, $text);

		// assert
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
		$author = EntityFactory::createUser();
		$post = $this->service->create($author, 'Some text of title', 'Some text of post');

		// act
		$this->service->remove($post->getId());

		// assert
		$this->assertEquals(0, $author->getPosts()->count());
	}

	public function testRemoveNonexistentShouldThrowException()
	{
		// arrange
		$this->setExpectedException('Blog\DomainBundle\Exception\DomainException');

		// act
		$this->service->remove(100500);
	}

	public function testGetAllPosts()
	{
		// act
		$posts = $this->service->getAllPosts();

		// assert
		$this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $posts);
		$this->assertContainsOnlyInstancesOf('Blog\DomainBundle\Entity\Post', $posts->getValues());
	}

	public function testGetPostById()
	{
		// act
		$post = $this->service->getPost(1);

		// assert
		$this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
		$this->assertEquals(1, $post->getId());
	}
}

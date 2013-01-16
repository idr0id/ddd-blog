<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Service\PostService;
use Blog\DomainBundle\Tests\BaseTestCase;

class PostServiceTest extends BaseTestCase
{
    /**
     * @var PostService
     */
    private $service;

    protected function setUp()
    {
        $this->service = new PostService($this->getDoctrine(), $this->getQueryFactory(), $this->getLogger());
    }

    public function testCreate()
    {
        $user = $this->getEntityFixtureManager()->getUser();
        $title = 'Some text of title';
        $text = 'Some text of post';

        $post = $this->service->create($user, $title, $text);

        $this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
        $this->assertInstanceOf('DateTime', $post->getCreated());
        $this->assertGreaterThan(0, $post->getId());
        $this->assertEquals($user, $post->getAuthor());
        $this->assertEquals($title, $post->getTitle());
        $this->assertEquals($text, $post->getText());
        $this->assertEquals($post, $user->getPosts()->get(0));
    }

    public function testRemove()
    {
        $user = $this->getEntityFixtureManager()->getUser();
        $post = $this->service->create($user, 'Some text of title', 'Some text of post');

        $this->service->remove($post->getId());

        $this->assertEquals(1, $user->getPosts()->count());
    }

    public function testRemoveNonexistentShouldThrowException()
    {
        $this->setExpectedException(
            'Blog\DomainBundle\Exception\DomainException',
            'Post "100500" does not exist'
        );
        $this->service->remove(100500);
    }

    public function testGetAllPosts()
    {
        $expectedPosts = $this->getEntityFixtureManager()->getAllPosts();

        $posts = $this->service->getAllPosts();

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $posts);
        $this->assertEquals($expectedPosts, $posts->getValues());
    }

    public function testGetPostById()
    {
        $expectedPosts = $this->getEntityFixtureManager()->getAllPosts();

        $post = $this->service->getPost($expectedPosts[0]->getId());

        $this->assertEquals($expectedPosts[0], $post);
    }
}

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
        $this->service = $this->get('domain.service.post');
    }

    public function testCreate()
    {
        $user = $this->getEntityFixtureManager()->getUser();
        $text = "Some text of post";

        $post = $this->service->create($user, $text);

        $this->assertInstanceOf('Blog\DomainBundle\Entity\Post', $post);
        $this->assertGreaterThan(0, $post->getId());
        $this->assertEquals($user, $post->getAuthor());
        $this->assertEquals($text, $post->getText());
        $this->assertEquals($post, $user->getPosts()->get(0));
    }

    public function testRemove()
    {
        $user = $this->getEntityFixtureManager()->getUser();
        $post = $this->service->create($user, "Some text of post");

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
}

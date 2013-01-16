<?php

namespace Blog\DomainBundle\Tests\Entity;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;

class PostTest extends BaseTestCase
{
    public function testCreatePost()
    {
		$author = EntityFactory::createUser();
		$title = 'Some title!';
		$text = 'Some looong text.';

		$post = new Post($author, $title, $text);

		$this->assertEquals($title, $post->getTitle());
		$this->assertEquals($text, $post->getText());
		$this->assertSame($author, $post->getAuthor());
		$this->assertTrue($author->getPosts()->contains($post));
    }
}

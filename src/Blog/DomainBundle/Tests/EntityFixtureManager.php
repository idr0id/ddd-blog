<?php

namespace Blog\DomainBundle\Tests;

use Blog\DomainBundle\Doctrine\QueryFactory;
use Blog\DomainBundle\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Registry;

class EntityFixtureManager
{
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getUser()
    {
        return $this->doctrine->getRepository('BlogDomainBundle:User')->findOneBy(array('login' => 'Tester'));
    }

    public function getPostUser()
    {
		return $this->doctrine->getRepository('BlogDomainBundle:User')->findOneBy(array('login' => 'PostTester'));
    }

    /**
     * @return Post[]
     */
    public function getAllPosts()
    {
        return $this->doctrine->getRepository('BlogDomainBundle:Post')->findAll();
    }
}

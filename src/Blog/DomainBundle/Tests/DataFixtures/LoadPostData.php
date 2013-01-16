<?php

namespace Blog\DomainBundle\Tests\DataFixtures;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Infrastructure\Doctrine\DoctrineHelper;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @return void
     */
    function load(ObjectManager $manager)
    {
        DoctrineHelper::truncate($manager, 'Blog\DomainBundle\Entity\Post');

        $user = new User('PostTester', 'PostTester');
        new Post($user, 'First title', 'First post');
        new Post($user, 'Second title', 'Second post');

        $manager->persist($user);
        $manager->flush();
    }
}

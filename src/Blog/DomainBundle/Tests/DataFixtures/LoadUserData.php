<?php

namespace Blog\DomainBundle\Tests\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Blog\DomainBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User('Tester', 'Tester');

        $manager->persist($user);
        $manager->flush();
    }
}
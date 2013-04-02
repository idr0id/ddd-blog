<?php

namespace Blog\DomainBundle\Tests\Unit\Entity;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Tests\TestCaseBase;

class UserTest extends TestCaseBase
{
	public function testPasswordShouldEqual()
	{
		// arrange
		$user = $this->createUser();
		// assert
		$this->assertTrue($user->isEqualPassword('password'));
	}

	public function testPasswordShouldNotEqual()
	{
		// arrange
		$user = $this->createUser();
		// assert
		$this->assertFalse($user->isEqualPassword('not-equal-password'));
	}

	public function testChangePasswordTo()
	{
		// arrange
		$user = $this->createUser();
		// act
		$user->changePasswordTo('changed-password');
		// assert
		$this->assertTrue($user->isEqualPassword('changed-password'));
	}

	public function testRemovePost()
	{
		// arrange
		$user = $this->createUser();
		$post = $this->createPost($user);
		// act
		$user->removePost($post);
		// assert
		$this->assertFalse($user->getPosts()->contains($post));
	}

	private function createUser()
	{
		return new User('login', 'password');
	}

	private function createPost(User $user)
	{
		return new Post($user, '', '');
	}
}

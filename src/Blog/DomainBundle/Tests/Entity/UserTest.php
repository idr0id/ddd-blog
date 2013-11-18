<?php

namespace Blog\DomainBundle\Tests\Entity;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Tests\TestCaseBase;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;

class UserTest extends TestCaseBase
{
	/**
	 * @var User
	 */
	private $user;

	protected function setUp()
	{
		$this->user = new User('login', 'password');
	}

	public function testEqualPassword()
	{
		// assert
		$this->assertTrue($this->user->checkPassword('password'));
	}

	public function testChangePasswordTo()
	{
		// act
		$this->user->changePasswordTo("changedPassword");
		// assert
		$this->assertTrue($this->user->checkPassword('changedPassword'));
	}

	public function testRemovePost()
	{
		// arrange
		$post = EntityFactory::createPost($this->user);
		// act
		$this->user->removePost($post);
		// assert
		$this->assertFalse($this->user->getPosts()->contains($post));
	}
}

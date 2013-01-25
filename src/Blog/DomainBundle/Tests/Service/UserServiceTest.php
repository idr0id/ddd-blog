<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Service\UserService;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\Fakes\FakeUnitOfWork;
use Blog\DomainBundle\Tests\Fakes\Repository\FakeUserRepository;

class UserServiceTest extends BaseTestCase
{
	/**
	 * @var UserService
	 */
	private $service;

	protected function setUp()
	{
		$this->service = new UserService(new FakeUnitOfWork(), new FakeUserRepository());
	}

	public function testRegisterNewUserShouldBeSuccess()
	{
		// act
		$user = $this->service->register('NewUser', 'NewPassword');

		// assert
		$this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
	}

	public function testRegisterExistsUserShouldBeFailed()
	{
		// arrange
		$this->setExpectedException('Blog\DomainBundle\Exception\UserAlreadyExistsException');

		// act
		$this->service->register('login 1', 'password 1');
	}
}

<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Service\UserService;
use Blog\DomainBundle\Tests\BaseTestCase;
use Blog\DomainBundle\Tests\Fakes\FakeUnitOfWork;
use Blog\DomainBundle\Tests\Fakes\Repository\FakeUserRepository;
use Mockery;

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
		$user = $this->service->register('NewUser', 'NewPassword');

		$this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
		$this->assertGreaterThan(0, $user->getId());
	}

	public function testRegisterExistsUserShouldBeFailed()
	{
		$this->setExpectedException('Blog\DomainBundle\Exception\UserAlreadyExistsException');

		$this->service->register('login 1', 'password 1');
	}
}

<?php

namespace Blog\DomainBundle\Tests\Unit\Service;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Service\UserService;
use Blog\DomainBundle\Tests\TestCaseBase;

class UserServiceTest extends TestCaseBase
{
	public function testRegisterNewUserShouldBeSuccess()
	{
		// arrange
		$service = $this->createUserService();
		// act
		$user = $service->register('new-login', 'new-password');
		// assert
		$this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
	}

	public function testRegisterExistsUserShouldBeFailed()
	{
		$this->setExpectedException('Blog\DomainBundle\Exception\UserAlreadyExistsException');
		// arrange
		$service = $this->createUserService();
		// act
		$service->register('test-login', 'test-password');
	}

	private function createUserService()
	{
		$unitOfWork = $this->getMockForAbstractClass('Blog\InfrastructureBundle\ORM\IUnitOfWork');
		$repository = new FakeRepository('Blog\DomainBundle\Entity\User', array(
			new User('test-login', 'test-password'),
		));
		return new UserService($unitOfWork, $repository);
	}
}

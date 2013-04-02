<?php

namespace Blog\DomainBundle\Tests\Integration\Specification\User;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Specification\User\LoginSpecification;
use Blog\DomainBundle\Tests\IntegrationTestCaseBase;

class LoginSpecificationTest extends IntegrationTestCaseBase
{
	public function testSatisfiedIsShouldBeTrue()
	{
		// arrange
		$specification = new LoginSpecification('Tester');
		$user = new User('Tester', '');
		// act
		$isSatisfiedBy = $specification->isSatisfiedBy($user);
		// assert
		$this->assertTrue($isSatisfiedBy);
	}

	public function testSatisfiedIsShouldBeFalse()
	{
		// arrange
		$specification = new LoginSpecification('Tester');
		$user = new User('Yet another tester', '');
		// act
		$isSatisfiedBy = $specification->isSatisfiedBy($user);
		// assert
		$this->assertFalse($isSatisfiedBy);
	}

	public function testSatisfiedIsShouldBeRaiseException()
	{
		$this->setExpectedException('\\BadMethodCallException');
		// arrange
		$specification = new LoginSpecification('Tester');
		// act
		$specification->isSatisfiedBy($this->getMock('Blog\InfrastructureBundle\ORM\IEntity'));
	}

	public function testRepositoryShouldFindUser()
	{
		// arrange
		$specification = new LoginSpecification('Tester');
		// act
		$user = $this->getRepository('user')->findBySpecification($specification);
		// assert
		$this->assertInstanceOf('Blog\\DomainBundle\\Entity\\User', $user);
	}
}

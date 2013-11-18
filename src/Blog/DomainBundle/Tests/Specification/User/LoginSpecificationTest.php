<?php

namespace Blog\DomainBundle\Tests\Specification\User;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Specification\User\LoginSpecification;
use Blog\DomainBundle\Tests\IntegrationTestCaseBase;

class LoginSpecificationTest extends IntegrationTestCaseBase
{
	public function testSatisfiedIsShouldBeTrue()
	{
		$specification = new LoginSpecification('Tester');
		$this->assertTrue($specification->isSatisfiedBy(new User('Tester', '')));
	}

	public function testSatisfiedIsShouldBeFalse()
	{
		$specification = new LoginSpecification('Tester');
		$this->assertFalse($specification->isSatisfiedBy(new User('Yet another tester', '')));
	}

	public function testRepositoryShouldFindUser()
	{
		$result = $this->getRepository('user')->findBySpecification(new LoginSpecification('Tester'));

		$this->assertInstanceOf('Blog\\DomainBundle\\Entity\\User', $result);
	}
}

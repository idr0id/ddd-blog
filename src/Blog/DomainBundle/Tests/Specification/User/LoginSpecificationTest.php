<?php

namespace Blog\DomainBundle\Tests\Specification\User;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Specification\User\LoginSpecification;
use Blog\DomainBundle\Tests\BaseTestCase;

class LoginSpecificationTest extends BaseTestCase
{
	/**
	 * @var LoginSpecification
	 */
	private $object;

	public function setUp()
	{
		$this->object = new LoginSpecification('Tester');
	}

	public function testImplements()
	{
		$this->assertInstanceOf('Blog\\DomainBundle\\Infrastructure\\ISpecification', $this->object);
		$this->assertInstanceOf('Blog\\DomainBundle\\Infrastructure\\ICriteriaSpecification', $this->object);
	}

	public function testSatisfiedIsShouldBeTrue()
	{
		$result = $this->object->isSatisfiedBy(new User('Tester', ''));

		$this->assertTrue($result);
	}

	public function testSatisfiedIsShouldBeFalse()
	{
		$result = $this->object->isSatisfiedBy(new User('Yet another tester', ''));

		$this->assertFalse($result);
	}

	public function testSatisfiedIsShouldBeRaiseException()
	{
		$this->setExpectedException('\\BadMethodCallException');

		$this->object->isSatisfiedBy(new \stdClass());
	}

	public function testRepositoryShouldFindUser()
	{
		$result = $this->get('doctrine')->getRepository('BlogDomainBundle:User')->findOneBySpecification($this->object);

		$this->assertInstanceOf('Blog\\DomainBundle\\Entity\\User', $result);
	}
}

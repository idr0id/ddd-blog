<?php

namespace Blog\DomainBundle\Specification\User;

use Blog\DomainBundle\Entity\User;
use Blog\InfrastructureBundle\ORM\IEntity;
use Blog\InfrastructureBundle\ORM\ISpecificationCriteria;
use Blog\InfrastructureBundle\ORM\ISpecification;
use Doctrine\Common\Collections\Criteria;

class LoginSpecification implements ISpecification, ISpecificationCriteria
{
	private $login;

	public function __construct($login)
	{
		$this->login = $login;
	}

	public function isSatisfiedBy(IEntity $object)
	{
		if (!$object instanceof User) {
			throw new \BadMethodCallException(sprintf("I only deal with users, you gave me: %s", get_class($object)));
		}

		return $object->getLogin() == $this->login;
	}

	public function getCriteria()
	{
		return Criteria::create()->where(Criteria::expr()->eq('login', $this->login));
	}
}

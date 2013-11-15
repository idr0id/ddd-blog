<?php

namespace Blog\DomainBundle\Specification\User;

use Blog\DomainBundle\Entity\User;
use Blog\InfrastructureBundle\ORM\ICriteriaSpecification;
use Blog\InfrastructureBundle\ORM\ISpecification;

class LoginSpecification implements ISpecification, ICriteriaSpecification
{
	private $login;

	public function __construct($login)
	{
		$this->login = $login;
	}

	public function isSatisfiedBy($object)
	{
		if (!$object instanceof User) {
			throw new \BadMethodCallException(sprintf("I only deal with users, you gave me: %s", get_class($object)));
		}

		return $object->getLogin() == $this->login;
	}

	/**
	 * @return array
	 */
	public function getCriteria()
	{
		return array('login' => $this->login);
	}
}

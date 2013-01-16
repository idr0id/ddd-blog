<?php

namespace Blog\DomainBundle\Tests\Fakes\Repository;

use Blog\DomainBundle\Infrastructure\ICriteriaSpecification;
use Blog\DomainBundle\Infrastructure\IEntity;
use Blog\DomainBundle\Infrastructure\IRepository;
use Blog\DomainBundle\Infrastructure\ISpecification;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;
use Blog\DomainBundle\Tests\Utils\Entity\EntityIdentityChanger;

class FakeUserRepository extends BaseFakeRepository
{
	function __construct()
	{
		$this->add(EntityFactory::createUser('login 1', 'password 1'));
		$this->add(EntityFactory::createUser('login 2', 'password 2'));
		$this->add(EntityFactory::createUser('login 3', 'password 3'));
	}

	protected function getEntityType()
	{
		return 'Blog\DomainBundle\Entity\User';
	}

	protected function changeIdentifier(IEntity $object)
	{
		EntityIdentityChanger::changeUserId($object, $this->generateId());
	}
}

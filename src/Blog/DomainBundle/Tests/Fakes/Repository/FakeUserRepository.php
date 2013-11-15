<?php

namespace Blog\DomainBundle\Tests\Fakes\Repository;

use Blog\DomainBundle\Entity\User;
use Blog\InfrastructureBundle\ORM\IEntity;
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
		if (!$object instanceof User) {
			throw new \Exception('Entity must be Post');
		}
		EntityIdentityChanger::changeUserId($object, $this->generateId());
	}
}

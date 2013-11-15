<?php

namespace Blog\DomainBundle\Tests\Fakes\Repository;

use Blog\DomainBundle\Entity\Post;
use Blog\InfrastructureBundle\ORM\IEntity;
use Blog\DomainBundle\Tests\Utils\Entity\EntityFactory;
use Blog\DomainBundle\Tests\Utils\Entity\EntityIdentityChanger;

class FakePostRepository extends BaseFakeRepository
{
	function __construct()
	{
		$this->add(EntityFactory::createPost(null, 'title 1', 'text 1'));
		$this->add(EntityFactory::createPost(null, 'title 2', 'text 2'));
		$this->add(EntityFactory::createPost(null, 'title 3', 'text 3'));
	}

	protected function getEntityType()
	{
		return 'Blog\DomainBundle\Entity\Post';
	}

	protected function changeIdentifier(IEntity $object)
	{
		if (!$object instanceof Post) {
			throw new \Exception('Entity must be Post');
		}
		EntityIdentityChanger::changePostId($object, $this->generateId());
	}
}

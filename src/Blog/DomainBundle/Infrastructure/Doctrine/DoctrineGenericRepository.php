<?php

namespace Blog\DomainBundle\Infrastructure\Doctrine;

use Blog\DomainBundle\Infrastructure\ICriteriaSpecification;
use Blog\DomainBundle\Infrastructure\IEntity;
use Blog\DomainBundle\Infrastructure\IRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineGenericRepository extends EntityRepository implements IRepository
{
	public function findById($id)
	{
		return $this->find($id);
	}

	public function findBySpecification(
		ICriteriaSpecification $specification,
		array $orderBy = null,
		$limit = null,
		$offset = null
	) {
		return $this->findBy($specification->isSatisfiedByCriteria(), $orderBy, $limit, $offset);
	}

	public function findOneBySpecification(ICriteriaSpecification $specification)
	{
		return $this->findOneBy($specification->isSatisfiedByCriteria());
	}

	public function findAll()
	{
		return parent::findAll();
	}

	public function add(IEntity $object)
	{
		$this->errorOnInvalidEntityType($object);
		$this->getEntityManager()->persist($object);
	}

	public function remove(IEntity $object)
	{
		$this->errorOnInvalidEntityType($object);
		$this->getEntityManager()->remove($object);
	}

	private function errorOnInvalidEntityType(IEntity $object)
	{
		if (get_class($object) !== $this->_entityName) {
			throw new \InvalidArgumentException(sprintf(
				'Invalid entity type %s supplied for repository of %s',
				$this->_entityName,
				get_class($object)
			));
		}
	}
}

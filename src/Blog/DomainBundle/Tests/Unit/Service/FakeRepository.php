<?php

namespace Blog\DomainBundle\Tests\Unit\Service;

use Blog\InfrastructureBundle\ORM\ISpecificationCriteria;
use Blog\InfrastructureBundle\ORM\IEntity;
use Blog\InfrastructureBundle\ORM\IRepository;
use Doctrine\Common\Collections\ArrayCollection;

class FakeRepository implements IRepository
{
	/**
	 * @var IEntity[]|ArrayCollection
	 */
	private $collection;
	/**
	 * @var string
	 */
	private $entityType;

	public function __construct($entityType, $entities)
	{
		$this->entityType = $entityType;
		$this->collection = new ArrayCollection();
		foreach ($entities as $entity) {
			$this->add($entity);
		}
	}

	public function findById($id)
	{
		return $this->collection->get($id);
	}

	public function findAll()
	{
		return $this->collection;
	}

	public function findBySpecification(ISpecificationCriteria $specification)
	{
		return $this->collection->matching($specification->getCriteria()->setMaxResults(1))->first();
	}

	public function findAllBySpecification(ISpecificationCriteria $specification)
	{
		return $this->collection->matching($specification->getCriteria());
	}

	public function add(IEntity $entity)
	{
		$this->errorOnInvalidEntityType($entity);
		if ($this->getIdentityValue($entity) < 1) {
			$this->setIdentityValue($entity, $this->collection->count() + 1);
		}
		$this->collection->set($entity->getId(), $entity);
	}

	public function remove(IEntity $object)
	{
		$this->errorOnInvalidEntityType($object);
		$this->collection->remove($object->getId());
	}

	public function update(IEntity $entity)
	{
		throw new \RuntimeException("Method update not implemented yet");
	}

	private function getIdentityValue(IEntity $entity)
	{
		$reflectionClass = new \ReflectionClass(get_class($entity));
		$reflectionProperty = $reflectionClass->getProperty('id');
		$reflectionProperty->setAccessible(true);
		return $reflectionProperty->getValue($entity);
	}

	private function setIdentityValue(IEntity $entity, $id)
	{
		$reflectionClass = new \ReflectionClass(get_class($entity));
		$reflectionProperty = $reflectionClass->getProperty('id');
		$reflectionProperty->setAccessible(true);
		$reflectionProperty->setValue($entity, $id);
	}

	private function errorOnInvalidEntityType($object)
	{
		if (!is_a($object, $this->entityType)) {
			throw new \InvalidArgumentException(sprintf('Invalid entity type "%s" supplied for repository of "%s"', $this->entityType, get_class($object)));
		}
	}
}

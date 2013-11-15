<?php

namespace Blog\DomainBundle\Tests\Fakes\Repository;

use Blog\InfrastructureBundle\ORM\ISpecificationCriteria;
use Blog\InfrastructureBundle\ORM\IEntity;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\ISpecification;
use Doctrine\Common\Collections\ArrayCollection;

abstract class BaseFakeRepository implements IRepository
{
	/**
	 * @var int
	 */
	private $lastId = 0;
	/**
	 * @var IEntity[]|ArrayCollection
	 */
	private $entities;

	public function __construct()
	{
		$this->entities = new ArrayCollection();
	}

	public function findById($id)
	{
		if (!isset($this->entities[$id])) {
			return null;
		}
		return $this->entities[$id];
	}

	public function findAll()
	{
		return array_values($this->entities);
	}

	public function findBySpecification(ISpecificationCriteria $specification)
	{
		if (!$specification instanceof ISpecification) {
			throw new \BadMethodCallException(sprintf('Specification "%s" must implements ISpecification interface', get_class($specification)));
		}
		foreach ($this->entities AS $entity) {
			if ($specification->isSatisfiedBy($entity)) {
				return $entity;
			}
		}
		return null;
	}

	public function findAllBySpecification(ISpecificationCriteria $specification)
	{
		return $this->entities->matching($specification);
	}

	public function add(IEntity $object)
	{
		$this->errorOnInvalidEntityType($object);

		if (intval($object->getId()) < 1) {
			$this->changeIdentifier($object);
		}

		$this->entities[$object->getId()] = $object;
	}

	public function remove(IEntity $object)
	{
		$this->errorOnInvalidEntityType($object);

		unset($this->entities[$object->getId()]);
	}

	public function update(IEntity $entity)
	{
	}

	abstract protected function getEntityType();

	abstract protected function changeIdentifier(IEntity $object);

	protected function generateId()
	{
		return ++$this->lastId;
	}

	private function errorOnInvalidEntityType($object)
	{
		if (get_class($object) != $this->getEntityType()) {
			throw new \InvalidArgumentException(sprintf('Invalid entity type "%s" supplied for repository of "%s"', $this->getEntityType(), get_class($object)));
		}
	}
}

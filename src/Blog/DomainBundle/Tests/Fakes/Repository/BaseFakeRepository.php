<?php

namespace Blog\DomainBundle\Tests\Fakes\Repository;

use Blog\InfrastructureBundle\ORM\ICriteriaSpecification;
use Blog\InfrastructureBundle\ORM\IEntity;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\ISpecification;

abstract class BaseFakeRepository implements IRepository
{
	/**
	 * @var int
	 */
	private $lastId = 0;
	/**
	 * @var IEntity[]
	 */
	private $entities;

	abstract protected function getEntityType();

	abstract protected function changeIdentifier(IEntity $object);

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

	public function findOneBySpecification(ICriteriaSpecification $specification)
	{
		if (!$specification instanceof ISpecification) {
			throw new \BadMethodCallException(
				sprintf('Specification "%s" must implements ISpecification interface', get_class($specification))
			);
		}
		foreach ($this->entities AS $entity) {
			if ($specification->isSatisfiedBy($entity)) {
				return $entity;
			}
		}
		return null;
	}

	public function findBySpecification(
		ICriteriaSpecification $specification,
		array $orderBy = null,
		$limit = null,
		$offset = null
	) {
		if (!$specification instanceof ISpecification) {
			throw new \BadMethodCallException(
				sprintf('Specification "%s" must implements ISpecification interface', get_class($specification))
			);
		}

		return array_filter(
			$this->entities,
			function ($entity) use ($specification) {
				return $specification->isSatisfiedBy($entity);
			}
		);
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

	protected function generateId()
	{
		return ++$this->lastId;
	}

	private function errorOnInvalidEntityType($object)
	{
		if (get_class($object) != $this->getEntityType()) {
			throw new \InvalidArgumentException(sprintf(
				'Invalid entity type "%s" supplied for repository of "%s"',
				$this->getEntityType(),
				get_class($object)
			));
		}
	}


}

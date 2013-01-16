<?php

namespace Blog\DomainBundle\Infrastructure;

interface IRepository
{
	public function findById($id);

	public function findAll();

	public function findBySpecification(ICriteriaSpecification $specification, array $orderBy = null, $limit = null, $offset = null);

	public function findOneBySpecification(ICriteriaSpecification $specification);

	public function add(IEntity $object);

	public function remove(IEntity $object);
}

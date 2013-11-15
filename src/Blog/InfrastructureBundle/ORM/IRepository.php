<?php

namespace Blog\InfrastructureBundle\ORM;

interface IRepository
{
	public function findById($id);
	public function findBySpecification(ISpecificationCriteria $specification);

	public function findAll();
	public function findAllBySpecification(ISpecificationCriteria $specification);

	public function add(IEntity $entity);
	public function remove(IEntity $entity);
	public function update(IEntity $entity);
}

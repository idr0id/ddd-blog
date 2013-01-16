<?php

namespace Blog\DomainBundle\Infrastructure;

use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
	public function findBySpecification(ICriteriaSpecification $specification, array $orderBy = null, $limit = null, $offset = null)
	{
		return $this->findBy($specification->isSatisfiedByCriteria(), $orderBy, $limit, $offset);
	}

	public function findOneBySpecification(ICriteriaSpecification $specification)
	{
		return $this->findOneBy($specification->isSatisfiedByCriteria());
	}
}

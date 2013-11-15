<?php

namespace Blog\InfrastructureBundle\ORM;

use Doctrine\ORM\QueryBuilder;

interface ISpecification
{
	public function isSatisfiedBy($object);
}

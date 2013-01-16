<?php

namespace Blog\DomainBundle\Infrastructure;

use Doctrine\ORM\QueryBuilder;

interface ISpecification
{
	public function isSatisfiedBy($object);
}

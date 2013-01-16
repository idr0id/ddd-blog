<?php

namespace Blog\DomainBundle\Infrastructure;

use Doctrine\DBAL\Query\QueryBuilder;

interface ICriteriaSpecification
{
	/**
	 * @return array
	 */
	public function isSatisfiedByCriteria();
}

<?php

namespace Blog\InfrastructureBundle\ORM;

interface ICriteriaSpecification
{
	/**
	 * @return array
	 */
	public function getCriteria();
}

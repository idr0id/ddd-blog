<?php

namespace Blog\InfrastructureBundle\ORM;

use Doctrine\Common\Collections\Criteria;

interface ISpecificationCriteria
{
	/**
	 * @return Criteria
	 */
	public function getCriteria();
}

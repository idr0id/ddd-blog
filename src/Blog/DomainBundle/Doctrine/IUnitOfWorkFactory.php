<?php

namespace Blog\DomainBundle\Doctrine;

use Blog\InfrastructureBundle\ORM\IUnitOfWork;

interface IUnitOfWorkFactory
{
	/**
	 * @return IUnitOfWork
	 */
	public function createUnitOfWork();
}

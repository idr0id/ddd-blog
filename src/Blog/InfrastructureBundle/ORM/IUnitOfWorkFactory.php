<?php

namespace Blog\InfrastructureBundle\ORM;

interface IUnitOfWorkFactory
{
	/**
	 * @return IUnitOfWork
	 */
	public function createUnitOfWork();
}

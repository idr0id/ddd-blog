<?php

namespace Blog\DomainBundle\Infrastructure;

interface IUnitOfWorkFactory
{
	/**
	 * @return IUnitOfWork
	 */
	public function createUnitOfWork();
}

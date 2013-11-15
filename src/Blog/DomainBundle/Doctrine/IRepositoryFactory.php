<?php

namespace Blog\DomainBundle\Doctrine;

interface IRepositoryFactory
{
	/**
	 * @return IRepository
	 */
	public function createUserRepository();

	/**
	 * @return IRepository
	 */
	public function createPostRepository();
}

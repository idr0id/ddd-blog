<?php

namespace Blog\InfrastructureBundle\ORM;

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

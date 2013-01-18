<?php

namespace Blog\DomainBundle\Infrastructure;

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

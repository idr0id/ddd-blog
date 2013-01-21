<?php

namespace Blog\DomainBundle\Infrastructure\Doctrine;

use Blog\DomainBundle\Infrastructure\IRepository;
use Blog\DomainBundle\Infrastructure\IRepositoryFactory;
use Blog\DomainBundle\Infrastructure\IUnitOfWork;
use Blog\DomainBundle\Infrastructure\IUnitOfWorkFactory;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DoctrineFactory implements IRepositoryFactory, IUnitOfWorkFactory
{
	private $doctrine;

	/**
	 * @param Registry $doctrine
	 */
	public function __construct(Registry $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	/**
	 * @return IRepository
	 */
	public function createUserRepository()
	{
		return $this->doctrine->getRepository('BlogDomainBundle:User');
	}

	/**
	 * @return IRepository
	 */
	public function createPostRepository()
	{
		return $this->doctrine->getRepository('BlogDomainBundle:Post');
	}

	/**
	 * @return IUnitOfWork
	 */
	public function createUnitOfWork()
	{
		return new DoctrineUnitOfWork($this->doctrine);
	}
}

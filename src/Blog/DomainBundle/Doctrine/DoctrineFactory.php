<?php

namespace Blog\DomainBundle\Doctrine;

use Blog\InfrastructureBundle\Doctrine\UnitOfWork;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\IUnitOfWork;
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
		return new UnitOfWork($this->doctrine);
	}
}

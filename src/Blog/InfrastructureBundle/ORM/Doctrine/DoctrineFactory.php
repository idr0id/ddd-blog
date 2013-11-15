<?php

namespace Blog\InfrastructureBundle\ORM\Doctrine;

use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\IRepositoryFactory;
use Blog\InfrastructureBundle\ORM\IUnitOfWork;
use Blog\InfrastructureBundle\ORM\IUnitOfWorkFactory;
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

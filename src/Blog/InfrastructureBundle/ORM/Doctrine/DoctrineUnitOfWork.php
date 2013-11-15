<?php

namespace Blog\InfrastructureBundle\ORM\Doctrine;

use Blog\InfrastructureBundle\ORM\IUnitOfWork;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DoctrineUnitOfWork implements IUnitOfWork
{
	private $doctrine;

	public function __construct(Registry $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function commit()
	{
		$this->doctrine->getManager()->flush();
	}
}

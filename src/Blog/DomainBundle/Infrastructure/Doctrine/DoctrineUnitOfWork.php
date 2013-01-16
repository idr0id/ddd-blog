<?php

namespace Blog\DomainBundle\Infrastructure\Doctrine;

use Blog\DomainBundle\Infrastructure\IUnitOfWork;
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

<?php

namespace Blog\DomainBundle\Tests\Fakes;

use Blog\InfrastructureBundle\ORM\IUnitOfWork;

class FakeUnitOfWork implements IUnitOfWork
{
	public function commit()
	{
	}
}

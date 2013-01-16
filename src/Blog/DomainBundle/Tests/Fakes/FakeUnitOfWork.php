<?php

namespace Blog\DomainBundle\Tests\Fakes;

use Blog\DomainBundle\Infrastructure\IUnitOfWork;

class FakeUnitOfWork implements IUnitOfWork
{
	public function commit()
	{
	}
}

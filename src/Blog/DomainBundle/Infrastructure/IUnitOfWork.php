<?php

namespace Blog\DomainBundle\Infrastructure;

interface IUnitOfWork
{
	public function commit();
}

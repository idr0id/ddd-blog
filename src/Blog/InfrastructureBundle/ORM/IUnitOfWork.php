<?php

namespace Blog\InfrastructureBundle\ORM;

interface IUnitOfWork
{
	public function commit();
}

<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Exception\UserAlreadyExistsException;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\IUnitOfWork;
use Blog\DomainBundle\Specification\User\LoginSpecification;

class UserService
{
	/**
	 * @var IRepository
	 */
	private $userRepository;

	/**
	 * @var IUnitOfWork
	 */
	private $uow;

	public function __construct(IUnitOfWork $uow, IRepository $userRepository)
	{
		$this->uow = $uow;
		$this->userRepository = $userRepository;
	}

	public function register($login, $password)
	{
		if ($this->userRepository->findOneBySpecification(new LoginSpecification($login))) {
			throw new UserAlreadyExistsException(sprintf('User "%s" already exists', $login));
		}

		$user = new User($login, $password);

		$this->userRepository->add($user);
		$this->uow->commit();

		return $user;
	}

}

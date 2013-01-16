<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Specification\User\LoginSpecification;
use Doctrine\ORM\EntityManager;
use Blog\DomainBundle\Exception\UserAlreadyExistsException;
use Blog\DomainBundle\Entity\User;

class UserService extends BaseService
{
    public function register($login, $password)
    {
        if ($this->getRepository('User')->findOneBySpecification(new LoginSpecification($login))) {
            throw new UserAlreadyExistsException(sprintf('User "%s" already exists', $login));
        }

        $user = new User($login, $password);
        $this->persist($user)->flush();
        return $user;
    }

}

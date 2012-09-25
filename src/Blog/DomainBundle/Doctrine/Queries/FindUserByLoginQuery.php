<?php

namespace Blog\DomainBundle\Doctrine\Queries;

use Blog\DomainBundle\Doctrine\BaseQuery;
use Blog\DomainBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

class FindUserByLoginQuery extends BaseQuery
{
    public function __construct($doctrine, $login)
    {
        parent::__construct($doctrine);
        $this->login = $login;
    }

    /**
     * @return User
     */
    public function execute()
    {
        return $this->getRepository(static::USER_ENTITY)
            ->findOneBy(array('login' => $this->login));
    }
}

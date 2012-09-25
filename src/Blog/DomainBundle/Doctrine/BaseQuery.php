<?php

namespace Blog\DomainBundle\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class BaseQuery
{
    const USER_ENTITY = 'Blog\DomainBundle\Entity\User';
    const POST_ENTITY = 'Blog\DomainBundle\Entity\Post';

    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param string $entityName
     * @return EntityRepository $repository
     */
    public function getRepository($entityName)
    {
        return $this->doctrine->getManager()->getRepository($entityName);
    }

    abstract public function execute();
}

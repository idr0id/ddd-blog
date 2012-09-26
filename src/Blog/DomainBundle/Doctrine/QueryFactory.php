<?php

namespace Blog\DomainBundle\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * @method \Blog\DomainBundle\Entity\User findUserByLogin($login)
 * @method \Blog\DomainBundle\Entity\Post findPostById($id)
 * @method \Doctrine\Common\Collections\ArrayCollection|\Blog\DomainBundle\Entity\Post[] findAllPosts()
 */
class QueryFactory
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function __call($name, $parameters)
    {
        if (count($parameters) == 0 || !$parameters[0] instanceof Registry) {
            array_unshift($parameters, $this->doctrine);
        }

        $queryClass = sprintf('\%s\Queries\%sQuery', __NAMESPACE__, ucfirst($name));
        return $this->createQuery($queryClass, $parameters)->execute();
    }

    private function createQuery($queryClass, $parameters)
    {
        $reflection = new \ReflectionClass($queryClass);

        if ($reflection->getConstructor()->getNumberOfRequiredParameters() > count($parameters)) {
            throw new \InvalidArgumentException(sprintf("Error while constructing '%s' query", $queryClass));
        }

        /** @var $query BaseQuery */
        $query = $reflection->newInstanceArgs($parameters);
        return $query;
    }
}

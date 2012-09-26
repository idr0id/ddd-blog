<?php

namespace Blog\DomainBundle\Doctrine\Queries;

use Blog\DomainBundle\Doctrine\BaseQuery;
use Blog\DomainBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;

class FindAllPostsQuery extends BaseQuery
{
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Post[]
     */
    public function execute()
    {
        $posts = $this->getRepository(self::POST_ENTITY)->findAll();
        return new ArrayCollection($posts);
    }
}

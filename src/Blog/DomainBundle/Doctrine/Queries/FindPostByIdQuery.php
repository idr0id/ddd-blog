<?php

namespace Blog\DomainBundle\Doctrine\Queries;

use Blog\DomainBundle\Doctrine\BaseQuery;
use Blog\DomainBundle\Entity\Post;

class FindPostByIdQuery extends BaseQuery
{
    public function __construct($doctrine, $id)
    {
        parent::__construct($doctrine);
        $this->id = $id;
    }

    public function execute()
    {
        return $this->getRepository(static::POST_ENTITY)
            ->findOneById($this->id);
    }
}

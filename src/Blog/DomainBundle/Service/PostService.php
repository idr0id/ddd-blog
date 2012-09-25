<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Exception\DomainException;

class PostService extends BaseService
{
    public function create(User $user, $text)
    {
        $post = new Post($user, $text);

        $this->persist($post)->flush();
        return $post;
    }

    public function remove($id)
    {
        $post = $this->getQueryFactory()->findPostById($id);

        if ($post === null) {
            throw new DomainException(sprintf('Post "%s" does not exist', $id));
        }

        $post->getAuthor()->removePost($post);

        $this->persist($post)->flush();
    }
}

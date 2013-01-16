<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Exception\DomainException;
use Doctrine\Common\Collections\ArrayCollection;

class PostService extends BaseService
{
    //<editor-fold desc="Domain">
    public function create(User $user, $title, $text)
    {
        $post = new Post($user, $title, $text);

        $this->persist($post)->flush();
        return $post;
    }

    public function remove($id)
    {
        $post = $this->getPost($id);

        if ($post === null) {
            throw new DomainException(sprintf('Post "%s" does not exist', $id));
        }

        $post->getAuthor()->removePost($post);

        $this->persist($post)->flush();
    }
    //</editor-fold>

    //<editor-fold desc="Repository">
    public function getPost($id)
    {
        return $this->getRepository('Post')->find($id);
    }

    public function getAllPosts()
    {
        return new ArrayCollection($this->getRepository('Post')->findAll());
    }
    //</editor-fold>
}

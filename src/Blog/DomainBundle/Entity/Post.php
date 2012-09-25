<?php

namespace Blog\DomainBundle\Entity;

class Post
{
    private $id;

    /** @var User */
    private $author;

    private $text;

    public function __construct(User $author, $text)
    {
        $this->setAuthor($author);
        $this->setText($text);
    }

    //<editor-fold desc="gets/sets">
    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    private function setAuthor(User $author = null)
    {
        $this->author = $author;
        $this->author->addPost($this);
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
    //</editor-fold>
}

<?php

namespace Blog\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Blog\DomainBundle\Infrastructure\Doctrine\DoctrineGenericRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
	 * @var User
	 */
	private $author;

	/**
	 * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
	 * @var Post
	 */
	private $post;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	private $text;

	/**
	 * @ORM\Column(type="integer")
	 * @var \DateTime
	 */
	private $created;

	function __construct(User $author, Post $post, $text)
	{
		$this->setAuthor($author)
			->setPost($post)
			->setText($text)
			->setCreated(new \DateTime());
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

	private function setAuthor(User $author)
	{
		$this->author = $author;
		return $this;
	}

	public function getPost()
	{
		return $this->post;
	}

	private function setPost(Post $post)
	{
		$this->post = $post;
		return $this;
	}

	public function getText()
	{
		return $this->text;
	}

	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @param \DateTime $created
	 */
	private function setCreated(\DateTime $created)
	{
		$this->created = $created;
	}
	//</editor-fold>
}

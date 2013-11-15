<?php

namespace Blog\DomainBundle\Entity;

use Blog\InfrastructureBundle\ORM\IEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post implements IEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
	 * @var User
	 */
	private $author;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	private $title;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	private $text;

	/**
	 * @var \DateTime
	 */
	private $created;

	public function __construct(User $author, $title, $text)
	{
		$this->setAuthor($author)
			->setTitle($title)
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

	private function setAuthor(User $author = null)
	{
		$this->author = $author;
		$this->author->addPost($this);
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
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

	public function setCreated(\DateTime $created)
	{
		$this->created = $created;
		return $this;
	}
	//</editor-fold>
}

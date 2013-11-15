<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Exception\DomainException;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\IUnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;

class PostService
{
	/**
	 * @var IRepository
	 */
	private $postRepository;

	/**
	 * @var IUnitOfWork
	 */
	private $uow;

	public function __construct(IUnitOfWork $uow, IRepository $postRepository)
	{
		$this->uow = $uow;
		$this->postRepository = $postRepository;
	}

	/**
	 * Returns post by id
	 *
	 * @param int $id
	 * @return Post
	 */
	public function getPost($id)
	{
		return $this->postRepository->findById($id);
	}

	/**
	 * Returns all posts
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getAllPosts()
	{
		return new ArrayCollection($this->postRepository->findAll());
	}

	/**
	 * Create post
	 *
	 * @param User $user
	 * @param string $title
	 * @param string $text
	 * @return Post
	 */
	public function create(User $user, $title, $text)
	{
		$post = new Post($user, $title, $text);

		$this->postRepository->add($post);
		$this->uow->commit();

		return $post;
	}

	/**
	 * Remove post
	 *
	 * @param int $id
	 * @throws DomainException
	 */
	public function remove($id)
	{
		$post = $this->getPost($id);

		if ($post === null) {
			throw new DomainException(sprintf('Post "%s" does not exist', $id));
		}

		$post->getAuthor()->removePost($post);

		$this->postRepository->add($post);
		$this->uow->commit();
	}
}

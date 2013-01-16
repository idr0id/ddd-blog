<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Exception\DomainException;
use Blog\DomainBundle\Infrastructure\IRepository;
use Blog\DomainBundle\Infrastructure\IRepositoryFactory;
use Blog\DomainBundle\Infrastructure\IUnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;

class PostService
{
	/**
	 * @var IRepository
	 */
	private $userRepository;

	/**
	 * @var IUnitOfWork
	 */
	private $uow;

	public function __construct(IUnitOfWork $uow, IRepository $postRepository)
	{
		$this->uow = $uow;
		$this->userRepository = $postRepository;
	}

	/**
	 * Returns post by id
	 *
	 * @param int $id
	 * @return Post
	 */
	public function getPost($id)
	{
		return $this->userRepository->findById($id);
	}

	/**
	 * Returns all posts
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getAllPosts()
	{
		return new ArrayCollection($this->userRepository->findAll());
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

		$this->userRepository->add($post);
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

		$this->userRepository->add($post);
		$this->uow->commit();
	}
}

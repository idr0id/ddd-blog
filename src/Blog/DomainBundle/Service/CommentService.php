<?php

namespace Blog\DomainBundle\Service;

use Blog\DomainBundle\Entity\Comment;
use Blog\DomainBundle\Entity\Post;
use Blog\DomainBundle\Entity\User;
use Blog\InfrastructureBundle\ORM\IRepository;
use Blog\InfrastructureBundle\ORM\IUnitOfWork;

class CommentService
{
	/**
	 * @var IRepository
	 */
	private $commentRepository;

	/**
	 * @var IUnitOfWork
	 */
	private $uow;

	public function __construct(IUnitOfWork $uow, IRepository $commentRepository)
	{
		$this->uow = $uow;
		$this->commentRepository = $commentRepository;
	}

	public function create(User $author, Post $post, $text)
	{
		$comment = new Comment($author, $post, $text);

		$this->commentRepository->add($comment);
		$this->uow->commit();

		return $comment;
	}
}

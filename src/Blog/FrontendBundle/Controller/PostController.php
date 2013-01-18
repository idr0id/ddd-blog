<?php

namespace Blog\FrontendBundle\Controller;

use Blog\DomainBundle\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/** @noinspection PhpUnusedAliasInspection */
use	Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostController extends Controller
{
	/**
	 * @Template()
	 * @return array
	 */
	public function indexAction()
	{
		return array('posts' => $this->getPostService()->getAllPosts());
	}

	/**
	 * @Template()
	 * @param int $id
	 * @return array
	 */
	public function viewAction($id)
	{
		return array('post' => $this->getPostService()->getPost($id));
	}

	/**
	 * @return PostService
	 */
	private function getPostService()
	{
		return $this->get('domain.service.post');
	}
}

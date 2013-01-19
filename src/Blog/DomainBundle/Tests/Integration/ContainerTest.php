<?php

namespace Blog\DomainBundle\Tests\Integration;

use Blog\DomainBundle\Tests\BaseIntegrationTestCate;

class ContainerTest extends BaseIntegrationTestCate
{
	public function testContains_UserService()
	{
		$this->assertInstanceOf(
			'Blog\DomainBundle\Service\UserService',
			$this->get('blog.domain.service.user')
		);
	}

	public function testContains_PostService()
	{
		$this->assertInstanceOf(
			'Blog\DomainBundle\Service\PostService',
			$this->get('blog.domain.service.post')
		);
	}
}

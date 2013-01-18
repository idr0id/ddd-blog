<?php

namespace Blog\DomainBundle\Tests;

class TestTest extends BaseTestCase
{
	public function testRepo()
	{
		$repository = $this->get('doctrine')->getRepository('BlogDomainBundle:User');
	}
}

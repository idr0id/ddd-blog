<?php

namespace Blog\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogFrontendBundle:Default:index.html.twig');
    }
}

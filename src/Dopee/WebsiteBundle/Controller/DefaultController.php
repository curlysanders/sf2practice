<?php

namespace Dopee\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DopeeWebsiteBundle:Default:index.html.twig', array('name' => $name));
    }
}

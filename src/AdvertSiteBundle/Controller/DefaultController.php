<?php

namespace AdvertSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@AdvertSite/Default/index.html.twig');
    }
}

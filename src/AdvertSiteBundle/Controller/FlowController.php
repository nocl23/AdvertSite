<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 06/06/2018
 * Time: 23:13
 */

namespace AdvertSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/flow", name="flow")
 */

class FlowController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/all", name="all_flow")
     */
    public function FlowDisplayAction(){

        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');

        $adverts = $repository->findBy(array("state"=>"published"));

        return $this->render("@AdvertSite/Flow/flow.html.twig",array("adverts"=>$adverts));
    }

}
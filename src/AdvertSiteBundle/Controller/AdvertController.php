<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 04/06/2018
 * Time: 22:02
 */

namespace AdvertSiteBundle\Controller;

use AdvertSiteBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Class UserController
 * @package AdvertSiteBundle\Controller
 *
 * @Route("/admin")
 */


class AdvertController extends Controller
{

    /**
     * @Route ("/create")
     */

    public function AdvertCreateAction(){
        $advert = new Advert();

        $advert->setUser("nono");
        $advert->setPublicationDate(new \DateTime());
        $advert->setTitle("Third publication");
        $advert->setDescription("My pretty description, Yes I Know , I tried to speak English, but It's not amazing...");
        $advert->setState("not published");

        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        return $this->redirectToRoute('cc');
    }

    /**
     * @Route ("/listAdvert")
     */

    public function AdvertListAction(){
        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        //$listAdverts = $repository->findAll();
        $listAdverts = $repository->findBy(array("user" => "coucou"));

        return $this->render('@AdvertSite/Admin/advert.html.twig', array("adverts"=>$listAdverts));

    }


}
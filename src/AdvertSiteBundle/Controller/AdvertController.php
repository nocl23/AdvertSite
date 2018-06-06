<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 04/06/2018
 * Time: 22:02
 */

namespace AdvertSiteBundle\Controller;

use AdvertSiteBundle\Entity\Advert;
use AdvertSiteBundle\Entity\User;
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
     * @Route ("/create", name="create")
     */

    public function AdvertCreateAction(){
        $advert = new Advert();

        $advert->setUser("nono");
        $advert->setPublicationDate(new \DateTime());
        $advert->setTitle("Third publication");
        $advert->setDescription("My pretty description, Yes I Know , I tried to speak English, but It's not amazing...");
        $advert->setState("published");

        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        // @TODO Redirect to Route to Create new Advert ( Form )
        return $this->redirectToRoute('listAdvert');
    }

    /**
     * @Route ("/listAdvert/user/{id}", name="listAdvert")
     * @TODO request with the id of the login user id
     */

    public function AdvertListAction($id){
        $user_repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:User');
        $user = $user_repository->findBy(array("id"=> $id));

        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        $listAdverts = $repository->findBy(array("user" => $user[0]->getUsername()));

        return $this->render('@AdvertSite/Admin/advert.html.twig', array("adverts"=>$listAdverts));

    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/remove/{id}", name="removeAdvert")
     */

    public function AdvertRemoveAction($id){
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        $advert = $repository->findOneBy(array("id"=>$id));
        if($advert->getState() == "not published"){
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('listAdvert');
    }


}
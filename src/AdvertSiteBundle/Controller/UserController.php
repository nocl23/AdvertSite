<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 20/05/2018
 * Time: 21:23
 */

namespace AdvertSiteBundle\Controller;

use AdvertSiteBundle\Entity\User;
use AdvertSiteBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AdvertSiteBundle\Controller\FlowController;

/**
 * Class UserController
 * @package AdvertSiteBundle\Controller
 *
 * @Route("/")
 */

class UserController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/createuser", name="create_user")
     */
    public function indexAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('cc');

        }
        return $this->render('@AdvertSite/Admin/coucou.html.twig',array('form'=>$form->createView()));
    }


    /**
     * @Route ("/cc", name="cc")
     */

    public function ccAction(){
        return $this->render('@AdvertSite/Admin/login.html.twig');
    }
}
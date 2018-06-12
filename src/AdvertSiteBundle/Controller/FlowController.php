<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 06/06/2018
 * Time: 23:13
 */

namespace AdvertSiteBundle\Controller;

use AdvertSiteBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * @Route ("/flow", name="flow")
 */

class FlowController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/all", name="allFlow")
     */
    public function FlowDisplayAction(Request $request){

        $comment = new Comment();
        $username = "";
        $form = "";

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ){

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $username = $user->getUsername();
            $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
            $adverts = $repository->findBy(array("state"=>"published"));

            $commentaire_rep = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Comment');
            $commentaires = $commentaire_rep->findAll();

            var_dump($commentaires);
            $comment->setUser($username);

            $form = $this->createFormBuilder($comment)
                ->add('content',TextType::class)
                ->add('advert_id',HiddenType::class)
                ->add('submit',SubmitType::class, array('label' => "Add Comment"))
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $advert = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                return $this->redirect("/flow/all");
            }
        }
        return $this->render("@AdvertSite/Flow/flow.html.twig",array(
            "adverts"=>$adverts,
            "formm" => $form,
            "comments" => $commentaires,
            "logged_user" => $username));
    }

}
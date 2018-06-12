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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function AdvertCreateAction(Request $request){
        //Retrieve login user

        $advert = new Advert();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $username = $user->getUsername();

        $user_repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:User');
        $user_db = $user_repository->findBy(array("username"=> $username));

        $author_note = $user_db[0]->getNote();

        $advert->setUser($user);
        $advert->setPublicationDate(new \DateTime());

        $form = $this->createFormBuilder($advert)
            ->add('title',TextType::class)
            ->add('description', TextareaType::class)
            ->add('state',ChoiceType::class,array(
                'choices' => array(
                    'published' => 'published',
                    'not published' => "not published",
                    'done' => 'done'
                ),
            ))
            ->add('submit',SubmitType::class, array('label' => "Create Advert"))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $advert = $form->getData();
            $advert_state = $form["state"]->getData();
            var_dump($advert_state);

            if($advert_state == "published" && $author_note > 4.4){
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

            }else if($advert_state != "published"){
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();
            }

            return $this->redirectToRoute('listAdvert');

        }
        return $this->render('@AdvertSite/Admin/coucou.html.twig',array(
            'form' =>$form->createView()));
    }

    /**
     * @Route ("/listAdvert", name="listAdvert")
     * @TODO request with the id of the login user id
     */

    public function AdvertListAction(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $user_repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:User');
        $user = $user_repository->findBy(array("id"=> $id));

        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        $listAdverts = $repository->findBy(array("user" => $user[0]->getUsername()));

        return $this->render('@AdvertSite/Admin/advert.html.twig', array(
            "adverts"=>$listAdverts,
            "user_id" => $id
        ));
    }

    /**
     * @param $id
     * @param $user_id
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

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/edit/{id}", name="editAdvert")
     */
    public function AdvertEditAction($id, Request $request){
        $repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        $advert = $repository->findOneBy(array("id"=>$id));

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $username = $user->getUsername();

        $user_repository = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:User');
        $user_db = $user_repository->findBy(array("username"=> $username));

        $author_note = $user_db[0]->getNote();

        $form = $this->createFormBuilder($advert)
            ->add('title',TextType::class)
            ->add('description', TextareaType::class)
            ->add('state',ChoiceType::class,array(
                'choices' => array(
                    'published' => 'published',
                    'not published' => "not published",
                    'done' => 'done'
                ),
            ))
            ->add('submit',SubmitType::class, array('label' => "Edit Advert"))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $advert = $form->getData();
            $advert_state = $form["state"]->getData();

            if($advert_state == "published" && $author_note > 4.4){
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

            }else if($advert_state != "published"){
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();
            }

            return $this->redirectToRoute('listAdvert');

        }
        return $this->render('@AdvertSite/Admin/edit.html.twig',array(
            'form' =>$form->createView()));

    }

}
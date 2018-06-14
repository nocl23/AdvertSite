<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 06/06/2018
 * Time: 23:13
 */

namespace AdvertSiteBundle\Controller;

use AdvertSiteBundle\Entity\Comment;
use AdvertSiteBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


/**
 * @Route ("/", name="flow")
 */

class FlowController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/", name="allFlow")
     */
    public function FlowDisplayAction(Request $request){

        $comment = new Comment();
        $username = "";
        $form = "";
        $note = new Note();
        $noteForm = "";

        $repository_advert = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Advert');
        $adverts = $repository_advert->findBy(array("state"=>"published"));

        $commentaire_rep = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Comment');
        $commentaires = $commentaire_rep->findAll();

        $repository_user = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:User');

        $repository_note = $this->getDoctrine()->getManager()->getRepository('AdvertSiteBundle:Note');


        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ){

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $username = $user->getUsername();

            $comment->setUser($username);
            $note->setCommentAuthor($username);

            $noteForm = $this->createFormBuilder($note)
                ->add('note',ChoiceType::class,array(
                    'choices' => array(
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5
                    ),))
                ->add('advertAuthor',HiddenType::class)
                ->add('submit',SubmitType::class, array('label' => "Notez l'auteur de l'annonce"))
                ->getForm();
            $noteForm->handleRequest($request);

            if($noteForm->isSubmitted() && $noteForm->isValid()){

                $noteAdvert = $noteForm->getData();

                $authorToNote = $noteForm["advertAuthor"]->getData();

                $author = $repository_user->findBy(array("username"=>"$authorToNote"));

                //$notes = $repository_note->findBy(array("advertAuthor"=>"$authorToNote"));

               //calcul de la moyenne
                $multip = $author[0]->getNote()+$noteForm["note"]->getData();

                $author[0]->setNote( $multip / (2));

                $em = $this->getDoctrine()->getManager();
                $em->persist($author[0]);
                $em->persist($noteAdvert);
                $em->flush();

                return $this->redirect("/");
            }

            $form = $this->createFormBuilder($comment)
                ->add('content',TextType::class)
                ->add('advert_id',HiddenType::class)
                ->add('submit',SubmitType::class, array('label' => "Add Comment"))
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $commentData = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentData);
                $em->flush();

                $commentAdvert = $repository_advert->findBy(array("id"=>$commentData->getAdvertId()));
                $commentAdvert[0]->setComment($commentData->getId());

                $em->persist($commentAdvert[0]);
                $em->flush();

                return $this->redirect("/");
            }
        }
        return $this->render("@AdvertSite/Flow/flow.html.twig",array(
            "adverts"=>$adverts,
            "formm" => $form,
            "comments" => $commentaires,
            "logged_user" => $username,
            "notes"=>$noteForm));
    }

}
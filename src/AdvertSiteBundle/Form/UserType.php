<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 20/05/2018
 * Time: 23:09
 */

namespace AdvertSiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AdvertSiteBundle\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('username', TextType::class, array('label' => 'username'))
            ->add('password', TextType::class, array('label' => 'password'))
            -> add('submit', SubmitType::class, array('label' => "submit"));
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
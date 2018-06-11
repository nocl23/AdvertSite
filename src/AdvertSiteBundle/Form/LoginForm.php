<?php
/**
 * Created by PhpStorm.
 * User: Noemie
 * Date: 21/05/2018
 * Time: 23:08
 */

namespace AdvertSiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('_username')
            ->add('_password')
        ;
    }

}
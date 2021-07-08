<?php

namespace App\Form;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
 
/**
 * Description of UserType
 *
 * @author sebastianvillar
 */
class UserType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = null;
        $builder
            ->add('name')
            ->add('username')
            ->add('password')
            ->add('role')
            ->add('save',SubmitType::class);
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>User::class,
            'csrf_protection'=>false
            )
        );    
    }
}

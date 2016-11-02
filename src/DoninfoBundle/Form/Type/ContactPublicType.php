<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class ContactPublicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Nom'
                )
            ))
            ->add('prenom', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Prénom'
                )
            ))
            ->add('courriel', EmailType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Courriel'
                )
            ))
            ->add('titre', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Veuillez donner un titre à votre message'
                )
            ))
            ->add('message', TextareaType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Votre message...'
                )
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label'     => false
            ))
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'Envoyer'    
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\ContactPublic'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_contactpublic';
    }


}

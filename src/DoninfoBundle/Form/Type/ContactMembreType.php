<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class ContactMembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet', ChoiceType::class, array(
                'required'  => true,
                'choices'   => array(
                    'remarque'  => 'Remarque ou commentaire',
                    'technique' => 'Problème technique',
                    'annonce'   => 'Problème avec une annonce'
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
            ->add('numannonce', TextType::class, array(
                'required'  => false,
                'attr'      => array(
                    'placeholder'   => 'Veuillez indiquer le numéro de l`\annonce'
                )
            ))
            ->add('recaptcha', EWZRecaptchaType::class)
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
            'data_class' => 'DoninfoBundle\Entity\ContactMembre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_contactmembre';
    }


}

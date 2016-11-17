<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomstructure', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Nom de votre structure'
                )
            ))
            ->add('sirenrna', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Numéro Siren / Siret / RNA'
                )
            ))
            ->add('activite', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Votre secteur d\'activité'
                )
            ))
            ->add('ape', TextType::class, array(
                'attr'      => array(
                    'placeholder'   => 'Numéro APE'
                )
            ))
            ->add('adresse', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Adresse de votre structure'
                )
            ))
            ->add('ville', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Ville'
                )
            ))
            ->add('codepostal', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Code postal'
                )
            ))
            ->add('siteweb', UrlType::class, array(
                'attr'      => array(
                    'placeholder'   => 'Site web'
                )
            ))
            ->add('telephone', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Numéro de téléphone'
                )
            ))
            ->add('courriel', RepeatedType::class, array(
                'type'      => EmailType::class,
                'required'  => true,
                'invalid_message'   => 'Les champs courriel doivent correspondre',
                'first_options'     => array(
                    'attr'              => array(
                        'placeholder'       => 'Adresse courriel')),
                'second_options'    => array(
                    'attr'              => array(
                        'placeholder'       => 'Confirmation courriel'))
            ))
            ->add('nomuser', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Votre nom'
                )
            ))
            ->add('prenomuser', TextType::class, array(
                'required'  => true,
                'attr'      => array(
                    'placeholder'   => 'Votre prénom'
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type'              => PasswordType::class,
                'required'          => true,
                'invalid_message'   => 'Les champs du mot de passe doivent correspondre',
                'first_options'     => array(
                    'attr'              => array(
                        'placeholder'       => 'Mot de passe')),
                'second_options'    => array(
                    'attr'              => array(
                        'placeholder'       => 'Confirmation mot de passe'))
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label'             => false
            ))
            ->add('envoyer', SubmitType::class, array(
                'label'       => 'Inscription'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_user';
    }


}

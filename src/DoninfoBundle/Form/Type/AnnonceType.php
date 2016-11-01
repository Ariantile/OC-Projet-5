<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use DoninfoBundle\Form\Type\ObjetAnnonceType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'required'      => true,
                'attr'          => array(
                    'placeholder'   => 'Titre de votre annonce'  
                )
            ))
            ->add('description', TextareaType::class, array(
                'required'      => true,
                'attr'          => array(
                    'placeholder'   => 'Description de votre annonce'  
                )
            ))
            ->add('datelimite', DateType::class, array(
                'required'      => false,
            ))
            ->add('choixadresse', ChoiceType::class, array(
                'mapped'        => false,
                'required'      => true,
                'choices'       => array(
                    'Adresse du compte' => true,
                    'Autre adresse'     => false
                )
            ))
            ->add('adresse', TextType::class, array(
                'required'      => true,
                'attr'          => array(
                    'placeholder'   => 'Adresse de retrait'  
                )
            ))
            ->add('ville', TextType::class, array(
                'required'      => true,
                'attr'          => array(
                    'placeholder'   => 'Ville'  
                )
            ))
            ->add('codepostal', TextType::class, array(
                'required'      => true,
                'attr'          => array(
                    'placeholder'   => 'Code postal'  
                )
            ))
            ->add('photo1', FileType::class, array(
                'required'      => false
            ))
            ->add('photo2', FileType::class, array(
                'required'      => false
            ))
            ->add('photo3', FileType::class, array(
                'required'      => false
            ))
            ->add('objetannonce', CollectionType::class, array(
                'entry_type'   => ObjetAnnonceType::class,
                    'allow_add'    => true,
                    'allow_delete' => true
            ))
            ->add('recaptcha', EWZRecaptchaType::class)
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'Publier'
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_annonce';
    }


}

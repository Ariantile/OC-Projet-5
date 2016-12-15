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
use DoninfoBundle\Form\Type\ObjetType;
use DoninfoBundle\Form\Type\ImageType;

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
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.titre',
                    'maxlength'     => '100'
                )
            ))
            ->add('description', TextareaType::class, array(
                'required'      => true,
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.description',
                    'rows'          => 10,
                    'maxlength'     => '2000'
                )
            ))
            ->add('datelimite', DateType::class, array(
                'required'      => false,
                'label'         => false,
                'widget'        => 'single_text',
                'input'         => 'datetime',
                'format'        => 'dd/MM/yyyy',
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.date',
                    'readonly'      => 'true'
                )
            ))
            ->add('adresse', TextType::class, array(
                'required'      => true,
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.adresse',
                    'maxlength'     => '100'
                )
            ))
            ->add('ville', TextType::class, array(
                'required'      => true,
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.ville',
                    'maxlength'     => '80'
                )
            ))
            ->add('codepostal', TextType::class, array(
                'required'      => true,
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.annonce.placeholder.postal',
                    'maxlength'     => '5'
                )
            ))
            ->add('images', CollectionType::class, array(
                'label'         => false,
                'required'      => false,
                'by_reference'  => false,
                'entry_type'    => ImageType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'entry_options' => array(
                        'label'         => false,
                        'attr'          => array(
                            'class'         => 'col-xs-4'
                        )
                    )
            ))
            ->add('objets', CollectionType::class, array(
                'label'         => false,
                'by_reference'  => false,
                'attr'          => array(
                    'class'         => 'form-post-objet'
                ),
                'entry_type'    => ObjetType::class,
                    'allow_add'     => true,
                    'allow_delete'  => true,
                    'entry_options' => array(
                        'label'         => false,
                        'attr'          => array(
                            'class'         => 'sous-bloc-objet'
                        )
                    )
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label'         => false
            ))
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'doninfo.objet.label.submit'
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

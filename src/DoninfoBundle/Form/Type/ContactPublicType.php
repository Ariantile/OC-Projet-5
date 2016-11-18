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
                'label'     => 'doninfo.contactp.label.nom',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactp.placeholder.nom',
                    'maxlength'     => '150'
                )
            ))
            ->add('prenom', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactp.label.prenom',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactp.placeholder.prenom',
                    'maxlength'     => '150'
                )
            ))
            ->add('courriel', EmailType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactp.label.courriel',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactp.placeholder.courriel',
                    'maxlength'     => '150'
                )
            ))
            ->add('titre', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactp.label.titre',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactp.placeholder.titre',
                    'maxlength'     => '100'
                )
            ))
            ->add('message', TextareaType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactp.label.msg',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactp.placeholder.msg',
                    'rows'          => 3,
                    'maxlength'     => '2000'
                )
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label'     => false
            ))
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'doninfo.contactp.label.send'    
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

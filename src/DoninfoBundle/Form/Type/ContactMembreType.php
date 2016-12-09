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
                'label'     => 'doninfo.contactm.label.sujet',
                'choices'   => array(
                    'doninfo.contactm.choice.remarque'  => 'remarque',
                    'doninfo.contactm.choice.technique' => 'technique',
                    'doninfo.contactm.choice.annonce'   => 'annonce'
                )
            ))
            ->add('titre', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactm.label.titre',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactm.placeholder.titre',
                    'maxlength'     => '100'
                )
            ))
            ->add('message', TextareaType::class, array(
                'required'  => true,
                'label'     => 'doninfo.contactm.label.msg',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactm.placeholder.msg',
                    'rows'          => 3,
                    'maxlength'     => '2000'
                )
            ))
            ->add('numannonce', TextType::class, array(
                'required'  => false,
                'label'     => 'doninfo.contactm.label.num',
                'attr'      => array(
                    'placeholder'   => 'doninfo.contactm.placeholder.num',
                    'maxlength'     => '100'
                )
            ))
            ->add('recaptcha', EWZRecaptchaType::class,array(
                'label'     => false
            ))
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'doninfo.contactm.label.send'
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

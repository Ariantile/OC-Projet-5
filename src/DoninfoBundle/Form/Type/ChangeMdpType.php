<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangeMdpType extends AbstractType
{    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, array(
                'type'              => PasswordType::class,
                'required'          => true,
                'invalid_message'   => 'Les champs du mot de passe doivent correspondre',
                'first_options'     => array(
                    'label'     => 'doninfo.inscription.label.pass',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.pass')),
                'second_options'    => array(
                    'label'     => 'doninfo.inscription.label.pass_conf',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.pass_conf'))
            ))
            ->add('envoyer',      SubmitType::class, array(
                'label'     => 'doninfo.mdpoublie.label.submit'
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

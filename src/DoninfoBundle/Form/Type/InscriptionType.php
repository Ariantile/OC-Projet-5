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
                'label'     => 'doninfo.inscription.label.structure',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.structure',
                    'maxlength'     => '150'
                )
            ))
            ->add('sirenrna', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.sirenrna',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.sirenrna',
                    'maxlength'     => '14'
                )
            ))
            ->add('activite', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.activite',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.activite',
                    'maxlength'     => '150'
                )
            ))
            ->add('ape', TextType::class, array(
                'label'     => 'doninfo.inscription.label.ape',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.ape',
                    'maxlength'     => '5'
                )
            ))
            ->add('adresse', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.adresse',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.adresse',
                    'maxlength'     => '150'
                )
            ))
            ->add('ville', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.ville',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.ville',
                    'maxlength'     => '80'
                )
            ))
            ->add('codepostal', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.postal',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.postal',
                    'maxlength'     => '12'
                )
            ))
            ->add('siteweb', UrlType::class, array(
                'label'     => 'doninfo.inscription.label.siteweb',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.siteweb',
                    'maxlength'     => '150'
                )
            ))
            ->add('telephone', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.tel',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.tel',
                    'maxlength'     => '20'
                )
            ))
            ->add('courriel', RepeatedType::class, array(
                'type'      => EmailType::class,
                'required'  => true,
                'invalid_message'   => 'doninfo.inscription.courriel.invalid',
                'first_options'     => array(
                    'label'             => 'doninfo.inscription.label.courriel',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.courriel',
                        'maxlength'         => '150')),
                'second_options'    => array(
                    'label'             => 'doninfo.inscription.label.courriel_conf',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.courriel_conf',
                        'maxlength'         => '150'))
            ))
            ->add('nomuser', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.nom',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.nom',
                    'maxlength'     => '150'
                )
            ))
            ->add('prenomuser', TextType::class, array(
                'required'  => true,
                'label'     => 'doninfo.inscription.label.prenom',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.prenom',
                    'maxlength'     => '150'
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type'              => PasswordType::class,
                'required'          => true,
                'invalid_message'   => 'doninfo.inscription.pass.invalid',
                'first_options'     => array(
                    'label'     => 'doninfo.inscription.label.pass',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.pass')),
                'second_options'    => array(
                    'label'     => 'doninfo.inscription.label.pass_conf',
                    'attr'              => array(
                        'placeholder'       => 'doninfo.inscription.placeholder.pass_conf'))
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label'             => false
            ))
            ->add('envoyer', SubmitType::class, array(
                'label'       => 'doninfo.inscription.label.send'
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

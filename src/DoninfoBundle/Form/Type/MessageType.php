<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MessageType extends AbstractType
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
                    'placeholder'   => 'doninfo.message.placeholder.titre',
                    'maxlength'     => '100'
                )
            ))
            ->add('contenumessage', TextareaType::class, array(
                'required'      => true,
                'label'         => false,
                'attr'          => array(
                    'placeholder'   => 'doninfo.message.placeholder.description',
                    'maxlength'     => '2000',
                    'rows'          => 5,
                )
            ))
            ->add('envoyer',      SubmitType::class, array(
                  'label'       => 'doninfo.message.label.submit'
            ))
       ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Message'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_message';
    }


}

<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MdpOublieType extends AbstractType
{    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courriel',      TextType::class, array(
                'label'     => 'doninfo.inscription.label.courriel',
                'attr'      => array(
                    'placeholder'   => 'doninfo.inscription.placeholder.courriel'
                )  
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
            'data_class' => 'DoninfoBundle\Entity\MdpOublie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_mdpoublie';
    }

}

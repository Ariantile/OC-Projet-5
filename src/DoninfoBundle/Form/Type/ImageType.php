<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('file', FileType::class, array(
                'required'      => false,
                'label'         => 'doninfo.image.label.photo',
                'attr'          => array(
                    'class'         => 'inp-file'
                ),
                'label_attr'    =>  array(
                    'class'         => 'inp-label'
                )
            ))
        ;
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) 
        {
            $image  = $event->getData();
            $form   = $event->getForm();
            
            if ($image) 
            {
                $form->add('deleteimg', CheckboxType::class, array(
                    'label'    => 'doninfo.objet.label.supprimer',
                    'required' => false,
                    'attr'      => array(
                        'class'     => 'checkbox-img'
                    )
                ));
            }
        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_image';
    }


}

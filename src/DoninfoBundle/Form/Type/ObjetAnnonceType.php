<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ObjetAnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class, array(
                'class'         => 'DoninfoBundle:Categorie',
                'choice_label'  => 'nom'
                ))
            ->add('etat', ChoiceType::class, array(
                'required'  => true,
                'choices'   => array(
                    'Opérationnel'      => 'Opérationnel',
                    'Ne fonctionne pas' => 'Ne fonctionne pas'
                )
            ))
            ->add('quantite', IntegerType::class, array(
                'required'  => true,
                'attr'          => array(
                    'min'           => 1,
                    'max'           => 99
                )
            ))
            ->add('description', TextareaType::class, array(
                'required'  => false,
            ))     
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\ObjetAnnonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_objetannonce';
    }


}

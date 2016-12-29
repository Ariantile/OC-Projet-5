<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RechercheType extends AbstractType
{  
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motcle', TextType::class, array(
                'required'  => false,
                'label'         => 'doninfo.recherche.label.motcle',
                'attr'      => array(
                    'placeholder'   => 'doninfo.recherche.placeholder.motcle'
                )
            ))
            ->add('departement', EntityType::class, array(
                'required'      => false,
                'label'         => 'doninfo.annonce.label.departement',
                'class'         => 'DoninfoBundle:Departement',
                'choice_label'  => 'nom',
                'attr'          => array(
                    'class'         => 'input-form-box form-control'
                )
            ))
            ->add('categorie', EntityType::class, array(
                'required'      => false,
                'label'         => 'doninfo.objet.label.categorie',
                'class'         => 'DoninfoBundle:Categorie',
                'choice_label'  => 'nom',
                'group_by'      => 'groupe',
                'attr'          => array(
                    'class'         => 'input-form-box form-control'
                )
            ))
            ->add('chercher', SubmitType::class, array(
                'label'     => 'doninfo.recherche.label.submit',  
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Recherche',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'search';
    }
}

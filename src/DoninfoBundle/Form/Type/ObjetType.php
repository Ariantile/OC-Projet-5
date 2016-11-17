<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ObjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class, array(
                'required'      => true,
                'label'         => 'doninfo.objet.label.categorie',
                'class'         => 'DoninfoBundle:Categorie',
                'choice_label'  => 'nom',
                'group_by'      => 'groupe',
                'attr'          => array(
                    'class'         => 'input-form-box form-control'
                )
            ))
            ->add('etat', ChoiceType::class, array(
                'required'      => true,
                'label'         => 'doninfo.objet.label.etat',
                'choices'       => array(
                    'Opérationnel'      => 'Opérationnel',
                    'Ne fonctionne pas'   => 'Ne fonctionne pas'
                ),
                'attr'          => array(
                    'class'         => 'input-form-box form-control'
                )
            ))
            ->add('quantite', IntegerType::class, array(
                'required'      => true,
                'label'         => 'doninfo.objet.label.qte',
                'attr'          => array(
                    'min'           => 1,
                    'max'           => 99,
                    'class'         => 'input-form-box form-control'
                )
            ))
            ->add('description', TextareaType::class, array(
                'required'      => false,
                'label'         => 'doninfo.objet.label.description',
                'attr'          => array(
                    'class'         => 'input-form-box form-control',
                    'rows'          => 3
                )
            ))     
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Objet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_objet';
    }


}

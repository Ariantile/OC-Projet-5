<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ObjetAnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', ChoiceType::class, array(
                'required'  => true,
                'choices'   => array(
                    'Ordinateur de bureau'  => array(
                        'PC complet - UC / écran / clavier / souris'    => 'PC complet',
                        'PC - UC uniquement'    => 'PC - UC',
                        'Mac'                   => 'Mac'           
                    ),
                    'Ordinateur portable'   => array(
                        'Netbook'               => 'NetBook',
                        'NoteBook'              => 'NoteBook',
                        'Ultraportable'         => 'Ultraportable',
                        'MacBook'               => 'MacBook'
                    ),
                    'Serveur'               => 'Serveur',
                    'Moniteur'              => array(
                        '15 pouces'             => '15 pouces',
                        '17 pouces'             => '17 pouces',
                        '19 pouces'             => '19 pouces',
                        '20 pouces'             => '20 pouces',
                        '22 pouces'             => '22 pouces',
                        '23 pouces'             => '23 pouces',
                        '24 pouces'             => '24 pouces',
                        '27 pouces et plus'     => '27 pouces et plus',
                        'CRT'                   => 'CRT'
                    ),
                    'Imprimante et scanner' => array(
                        'Imprimante seule'      => array(
                            'Jet d\'encre'          => 'Imprimante jet d\'encre',
                            'Laser'                 => 'Imprimante laser'
                        ),
                        'Multifonction'         => array(
                            'Jet d\'encre'          => 'Imprimante multifonction jet d\'encre',
                            'Laser'                 => 'Imprimante multifonction laser'
                        ),
                        'Scanner seul'          => 'Scanner seul'
                    ),
                    'Périphérique et connectique'   => array(
                        'Clavier'               => 'Clavier',
                        'Souris'                => 'Souris',
                        'Son'                   => 'Son',
                        'Connectique'           => 'Connectique'
                    ),
                    'Stockage'              => array(
                        'Disque dur interne'    => 'Disque dur interne',
                        'Disque dur externe'    => 'Disque dur externe',
                        'Nas'                   => 'Nas'
                    ),
                    'Réseau'                => array(
                        'Routeur'               => array(
                            'Avec wifi'             => 'Router wifi',
                            'Sans wifi'             => 'Router',
                        ),
                        'Carte réseau'          => array(
                            'Wifi'                  => 'Carte réseau wifi',
                            'Cable'                 => 'Carte réseau cable'
                        ),
                        'Hub et switch'         => 'Hub et switch'
                    ),
                    'Composant'             => array(
                        'Carte mère'            => 'Carte mère',
                        'Processeur'            => 'Processeur',
                        'Mémoire'               => 'Mémoire',
                        'Carte graphique'       => 'Carte graphique',
                        'Alimentation'          => 'Alimentation',
                        'Carte son'             => 'Carte son',
                        'Boitier vide'          => 'Boitier vide'
                    ),
                    'Autre'                 => 'autre'
                )
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

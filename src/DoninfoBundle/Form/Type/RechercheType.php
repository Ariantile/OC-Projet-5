<?php

namespace DoninfoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
                'attr'      => array(
                    'placeholder'   => 'Chercher...'
                )
            ))
            ->add('region')
            ->add('departement')
            ->add('categorie', ChoiceType::class, array(
                'required'  => false,
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
                    'Serveur'               => array(
                        'Serveur'               => 'Serveur'
                    ),
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
                        'Scanner seul'          => array(
                            'Scanner seul'          => 'Scanner seul'
                        )
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
                        'Hub et switch'          => array(
                            'Hub et switch'         => 'Hub et switch'
                        )
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
                    'Autre'                 => array(
                        'Autre'                 => 'autre'
                    )
                )
            ))
            ->add('chercher', SubmitType::class, array(
                'label'     => 'Chercher'
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoninfoBundle\Entity\Recherche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doninfobundle_recherche';
    }


}

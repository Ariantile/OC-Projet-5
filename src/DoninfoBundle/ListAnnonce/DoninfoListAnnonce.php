<?php
// src/DoninfoBundle/ListMessages/DoninfoListMessages.php

namespace DoninfoBundle\ListAnnonce;

use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

class DoninfoListAnnonce extends PaginatorAware
{
    protected $requestStack;
    protected $doctrine;
    
    public function __construct($doctrine, $requestStack)
    {      
        $this->doctrine = $doctrine;
        $this->requestStack = $requestStack;
    }

    /**
     * Lister les annonces du membre identifié
     *
     */
    public function listerAnnonceMembre($user, $limit, $statut)
    {
        $em         = $this->doctrine->getManager();
        
        $request    = $this->requestStack->getCurrentRequest();
        
        $userid     = $user->getId();
        $dql        = "SELECT a FROM DoninfoBundle:Annonce a
                       WHERE a.user = :userid
                       AND a.statut = :statut
                       ORDER BY a.datecreation DESC";
            
        $query      = $em->createQuery($dql)->setParameters(array('userid' => $userid, 'statut' => $statut));
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
    
    /**
     * Lister les annonces favorite du membre identifié
     *
     */
    public function listerAnnonceMembreFavoris($user, $limit)
    {
        $em         = $this->doctrine->getManager();
        $request    = $this->requestStack->getCurrentRequest();
        $userid     = $user->getId();
        
        $dql        = "SELECT f FROM DoninfoBundle:Favoris f
                       LEFT JOIN f.annonce a
                       LEFT JOIN a.images img
                       WHERE f.user = :userid
                       ORDER BY a.datecreation DESC";
            
        $query      = $em->createQuery($dql)->setParameters(array('userid' => $userid));
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
    
    /**
     * Lister les annonces
     *
     */
    public function listerAnnonceAll($type, $limit)
    {
        $em         = $this->doctrine->getManager();
        $request    = $this->requestStack->getCurrentRequest();
        $dql        = "SELECT a FROM DoninfoBundle:Annonce a 
                       LEFT JOIN a.images img
                       WHERE a.type = :type
                       AND a.statut = :statut
                       ORDER BY a.datecreation DESC";
        
        $query      = $em->createQuery($dql)->setParameters(array('statut' => 'En cours', 'type' => $type));

        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
    
    /**
     * Lister les annonces
     *
     */
    public function rechercheAnnonce($type, $limit, $recherche)
    {
        $em         = $this->doctrine->getManager();
        $request    = $this->requestStack->getCurrentRequest();
        
        $motcle         = $recherche->getMotcle();
        $departement    = $recherche->getDepartement();
        $categorie      = $recherche->getCategorie();
        
        if ( (!isset($motcle)       || $motcle === ''       || $motcle === null) && 
             (!isset($departement)  || $departement === ''  || $departement === null) && 
             (!isset($categorie)    || $categorie === ''    || $categorie === null) )
        {
            $dql    = "SELECT a FROM DoninfoBundle:Annonce a 
                       LEFT JOIN a.images img
                       WHERE a.type = :type
                       AND a.statut = :statut
                       ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type));


        } else if ((isset($motcle)       || $motcle !== ''       || $motcle !== null) && 
                   (!isset($departement) || $departement === ''  || $departement === null) && 
                   (!isset($categorie)   || $categorie === ''    || $categorie === null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.titre LIKE  :motcle
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type, 
                                                                  'motcle'  => '%'.$motcle.'%'));
            
        } else if ((!isset($motcle)       || $motcle === ''       || $motcle === null) && 
                   (isset($departement)   || $departement !== ''  || $departement !== null) && 
                   (!isset($categorie)    || $categorie === ''    || $categorie === null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.departement =  :departement
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'      => 'En cours', 
                                                                  'type'        => $type, 
                                                                  'departement' => $departement));
            
        } else if ((!isset($motcle)        || $motcle === ''       || $motcle === null) && 
                   (!isset($departement)   || $departement === ''  || $departement === null) && 
                   (isset($categorie)      || $categorie !== ''    || $categorie !== null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    LEFT JOIN a.objets obj
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND obj.categorie =  :categorie
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'      => 'En cours', 
                                                                  'type'        => $type, 
                                                                  'categorie'   => $categorie));
            
        } else if ((isset($motcle)        || $motcle !== ''       || $motcle !== null) && 
                   (isset($departement)   || $departement !== ''  || $departement !== null) && 
                   (!isset($categorie)    || $categorie === ''    || $categorie === null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.titre LIKE  :motcle
                    AND a.departement = :departement
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type, 
                                                                  'motcle'  => '%'.$motcle.'%',
                                                                  'departement' => $departement));
        
        }  else if ((isset($motcle)        || $motcle !== ''       || $motcle !== null) && 
                   (!isset($departement)   || $departement === ''  || $departement === null) && 
                   (isset($categorie)      || $categorie !== ''    || $categorie !== null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    LEFT JOIN a.objets obj
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.titre LIKE  :motcle
                    AND obj.categorie =  :categorie
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type, 
                                                                  'motcle'  => '%'.$motcle.'%',
                                                                  'categorie'   => $categorie));
            
        } else if ((!isset($motcle)        || $motcle === ''       || $motcle === null) && 
                   (isset($departement)    || $departement !== ''  || $departement !== null) && 
                   (isset($categorie)      || $categorie !== ''    || $categorie !== null) )
        {
            
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    LEFT JOIN a.objets obj
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.departement = :departement
                    AND obj.categorie =  :categorie
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type, 
                                                                  'categorie'   => $categorie,
                                                                  'departement' => $departement));
            
        } else if ((isset($motcle)         || $motcle !== ''       || $motcle !== null) && 
                   (isset($departement)    || $departement !== ''  || $departement !== null) && 
                   (isset($categorie)      || $categorie !== ''    || $categorie !== null) )
        {
            $dql = "SELECT a FROM DoninfoBundle:Annonce a 
                    LEFT JOIN a.images img
                    LEFT JOIN a.objets obj
                    WHERE a.type = :type
                    AND a.statut = :statut
                    AND a.titre LIKE  :motcle
                    AND a.departement = :departement
                    AND obj.categorie =  :categorie
                    ORDER BY a.datecreation DESC";
            
            $query  = $em->createQuery($dql)->setParameters(array('statut'  => 'En cours', 
                                                                  'type'    => $type,
                                                                  'motcle'  => '%'.$motcle.'%',
                                                                  'categorie'   => $categorie,
                                                                  'departement' => $departement));
            
        }
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
    
    
}

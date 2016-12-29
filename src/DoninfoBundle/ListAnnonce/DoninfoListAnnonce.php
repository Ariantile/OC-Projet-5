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
        
        $query_motcle       = " AND a.titre LIKE  :motcle";
        $query_departement  = " AND a.departement =  :departement";
        $query_categorie    = " AND obj.categorie =  :categorie";
        
        $param_motcle       = 'motcle';
        $param_departement  = 'departement';
        $param_categorie    = 'categorie';
        
        
        $criteres = array(
                array('param' => $motcle, 'requete' => $query_motcle, 'nomparam' =>  $param_motcle),
                array('param' => $departement, 'requete' => $query_departement, 'nomparam' => $param_departement),
                array('param' => $categorie, 'requete' => $query_categorie, 'nomparam' => $param_categorie)
        );
         
        $parameters = array ('statut'       => 'En cours',
                             'type'         => $type
        );
        
        $dqlquery = "";
        
        foreach($criteres as $row)
        {
            if ($row['param'] !== null && $row['param'] !== '')
            {
                $dqlquery = $dqlquery . $row['requete'];
                
                if ($row['nomparam'] === 'motcle')
                {
                    $new_param = array($row['nomparam'] => '%'.$row['param'].'%');
                    
                } else {
                    $new_param = array($row['nomparam'] => $row['param']);
                }
                
                $parameters = array_merge($parameters, $new_param);
            }
        }
            
        $dql    = "SELECT a FROM DoninfoBundle:Annonce a 
                   LEFT JOIN a.images img
                   LEFT JOIN a.objets obj
                   WHERE a.statut = :statut
                   AND a.type = :type ". $dqlquery ." ORDER BY a.datecreation DESC";
        
        $query  = $em->createQuery($dql)->setParameters($parameters);
       
        $page   = $request->query->getInt('page', 1);
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query,
            $page,
            $limit
        );
        
        return $pagination;
    }
    
}

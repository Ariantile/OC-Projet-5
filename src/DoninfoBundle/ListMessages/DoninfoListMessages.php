<?php
// src/DoninfoBundle/ListMessages/DoninfoListMessages.php

namespace DoninfoBundle\ListMessages;

use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

class DoninfoListMessages extends PaginatorAware
{
    protected $requestStack;
    protected $doctrine;
    
    public function __construct($doctrine, $requestStack)
    {      
        $this->doctrine = $doctrine;
        $this->requestStack = $requestStack;
    }

    /**
     * Lister les messages recu du membre identifié
     *
     */
    public function listerMessages($user, $limit, $new)
    {
        $em         = $this->doctrine->getManager();
        
        $request    = $this->requestStack->getCurrentRequest();
        
        $userid     = $user->getId();
        
        $dql        = 'SELECT m FROM DoninfoBundle:Message m
                       LEFT JOIN m.annonce a
                       WHERE a.user = :userid
                       AND m.newm   = :new
                       ORDER BY m.datemsg DESC';
            
        $query      = $em->createQuery($dql)->setParameters(array('userid' => $userid, 'new' => $new));
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
    
    /**
     * Lister les messages envoyés du membre identifié
     *
     */
    public function listerMessagesSend($user, $limit)
    {
        $em         = $this->doctrine->getManager();
        
        $request    = $this->requestStack->getCurrentRequest();
        
        $userid     = $user->getId();
        
        $dql        = 'SELECT m FROM DoninfoBundle:Message m
                       LEFT JOIN m.annonce a
                       WHERE m.user = :userid
                       ORDER BY m.datemsg DESC';
            
        $query      = $em->createQuery($dql)->setParameters(array('userid' => $userid));
        
        $paginator  = $this->getPaginator();
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            $limit
        );
        
        return $pagination;
    }
}

<?php

namespace DoninfoBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CourrielmdpValidator extends ConstraintValidator
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    public function validate($value, Constraint $constraint)
    {   
        $usercheck = $this->em->getRepository('DoninfoBundle:User')->findOneByCourriel($value);
            
        if ($usercheck === null)
        {
            $this->context->addViolation($constraint->message);
        } else if ($usercheck->getStatut() === 'Banni') {
            $this->context->addViolation($constraint->message);
        }
    }
}
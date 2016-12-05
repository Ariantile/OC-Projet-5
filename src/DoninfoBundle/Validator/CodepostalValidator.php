<?php

namespace DoninfoBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CodepostalValidator extends ConstraintValidator
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    public function validate($value, Constraint $constraint)
    {

        if (substr($value, 0, 2) === 97)
        {
            $codepostal = substr($value, 0, 3);
        } else {
            $codepostal = substr($value, 0, 2);
        }
            
        $departement = $this->em->getRepository('DoninfoBundle:Departement')->findOneByCode($codepostal);
            
        if ($departement === null)
        {
            $this->context->addViolation($constraint->message);
        }
    }
}
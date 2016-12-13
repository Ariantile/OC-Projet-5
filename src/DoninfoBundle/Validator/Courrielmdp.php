<?php

namespace DoninfoBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
 
class Courrielmdp extends Constraint
{
    public $message = 'Adresse courriel invalide, veuillez vérifier les informations saisies.';
    
    public function validatedBy()
    {
        return 'doninfo_valid_cmdp';
    }
}

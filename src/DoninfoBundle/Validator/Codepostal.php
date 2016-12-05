<?php

namespace DoninfoBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
 
class Codepostal extends Constraint
{
    public $message = 'Code postal non reconnu, veuillez entrer un code postal valide';
    
    public function validatedBy()
    {
        return 'doninfo_valid_cp';
    }
}

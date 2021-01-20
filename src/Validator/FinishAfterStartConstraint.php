<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FinishAfterStartConstraint extends Constraint
{
    public $message = 'Finish should be later than start =) ';
}
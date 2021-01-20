<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AvailableRentDateIntervalConstraint extends Constraint
{
    public $message = 'This time interval is not available';
}
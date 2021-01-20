<?php

namespace App\Validator;

use App\Entity\RentalContract;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class FinishAfterStartConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof FinishAfterStartConstraint) {
            throw new UnexpectedTypeException($constraint, FinishAfterStartConstraint::class);
        }

        /** @var RentalContract $value */

        if ($value->getStartAt() >= $value->getFinishAt()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('finishAt')
                ->addViolation();
        }
    }
}
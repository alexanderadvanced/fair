<?php

namespace App\Validator;

use App\Entity\RentalContract;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class AvailableRentDateIntervalConstraintValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof AvailableRentDateIntervalConstraint) {
            throw new UnexpectedTypeException($constraint, AvailableRentDateIntervalConstraint::class);
        }
        /** @var RentalContract $value */

        $overlappingRental = $this->entityManager
            ->getRepository(RentalContract::class)
            ->findInBetween($value->getRentalObject(), $value->getStartAt(), $value->getFinishAt(), $value->getId() ? $value : null);

        if ($overlappingRental) {
            $this->context->buildViolation($constraint->message)
                ->atPath('startAt')
                ->addViolation();
        }
    }
}
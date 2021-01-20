<?php

namespace App\Form;

use App\Entity\RentalContract;
use App\Validator\AvailableRentDateIntervalConstraint;
use App\Validator\FinishAfterStartConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startAt', DatePickerType::class)
            ->add('finishAt', DatePickerType::class)
            ->add('rentalObject');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalContract::class,
            'constraints' => [
                new FinishAfterStartConstraint(),
                new AvailableRentDateIntervalConstraint(),
            ],
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\RentalContract;
use App\Entity\RentalObject;
use App\Form\RentalContractType;
use App\Form\RentalObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/", name="rental_object_") */
class RentalController extends AbstractController
{
    /** @Route("", name="list") */
    public function index(): Response
    {
        return $this->render('rental_object/index.html.twig', [
            'objects' => $this->getDoctrine()->getRepository(RentalObject::class)->findAll(),
        ]);
    }

    /** @Route("view/{id}", name="view") */
    public function view(Request $request, RentalObject $object): Response
    {
        $rentalContract = (new RentalContract())->setRentalObject($object);
        $form = $this->createForm(RentalContractType::class, $rentalContract, [
            'allow_extra_fields' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $this->handleContractForm($form);

            return $this->redirectToRoute('rental_object_view', [
                'id' => $object->getRentalObject()->getId(),
            ]);
        }

        return $this->render('rental_object/view.html.twig', [
            'object' => $object,
            'rentalContractForm' => $form->createView(),
            'openForm' => $form->isSubmitted(),
        ]);
    }

    /** @Route("edit/object/{id?}", name="edit_object") */
    public function editObject(Request $request, RentalObject $object = null): Response
    {
        $form = $this->createForm(RentalObjectType::class, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $object = $form->getData();

            if (!$object->getId()) {
                $entityManager->persist($object);
            }
            $this->addFlash('success', sprintf('Rental object was %s', $object->getId() ? 'updated' : 'created'));
            $entityManager->flush();

            return $this->redirectToRoute('rental_object_view', [
                'id' => $object->getId(),
            ]);
        }

        return $this->render('rental_object/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** @Route("edit/contract/{id?}", name="edit_contract") */
    public function editContract(Request $request, RentalContract $object = null): Response
    {
        $form = $this->createForm(RentalContractType::class, $object, [
            'allow_extra_fields' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $this->handleContractForm($form);

            return $this->redirectToRoute('rental_object_view', [
                'id' => $object->getRentalObject()->getId(),
            ]);
        }

        return $this->render('rental_contract/edit.html.twig', [
            'form' => $form->createView(),
            'contract' => $object,
        ]);
    }

    // form events and handlers can be used for this (Form::SUBMIT, ::SET_DATA etc..)
    protected function handleContractForm(FormInterface $form): RentalContract
    {
        /** @var RentalContract $object */
        $object = $form->getData();
        $extraData = $form->getExtraData();
        $object
            ->setResidents(array_filter($extraData['residents'] ?? []))
            ->setParties(array_filter($extraData['parties'] ?? []));
        $entityManager = $this->getDoctrine()->getManager();

        if (!$object->getId()) {
            $entityManager->persist($object);
        }
        $entityManager->flush();

        return $object;
    }
}

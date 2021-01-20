<?php

namespace App\Entity;

use App\Repository\RentalContractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalContractRepository::class)
 */
class RentalContract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $startAt;

    /**
     * @ORM\Column(type="date")
     */
    private $finishAt;

    /**
     * @ORM\ManyToOne(targetEntity=RentalObject::class, inversedBy="rentalContracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rentalObject;

    /**
     * @ORM\Column(type="string", length=3000, nullable=true)
     */
    private $residents;

    /**
     * @ORM\Column(type="string", length=3000, nullable=true)
     */
    private $parties;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getFinishAt(): ?\DateTimeInterface
    {
        return $this->finishAt;
    }

    public function setFinishAt(\DateTimeInterface $finishAt): self
    {
        $this->finishAt = $finishAt;

        return $this;
    }

    public function getRentalObject(): ?RentalObject
    {
        return $this->rentalObject;
    }

    public function setRentalObject(?RentalObject $rentalObject): self
    {
        $this->rentalObject = $rentalObject;

        return $this;
    }

    public function getResidents()
    {
        return json_decode($this->residents ?? '[]', true);
    }

    public function setResidents($residents): self
    {
        $this->residents = json_encode($residents);

        return $this;
    }

    public function getParties()
    {
        return json_decode($this->parties ?? '[]', true);
    }

    public function setParties($parties)
    {
        $this->parties = json_encode($parties);
    }
}

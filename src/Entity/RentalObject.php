<?php

namespace App\Entity;

use App\Repository\RentalObjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalObjectRepository::class)
 */
class RentalObject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=RentalContract::class, mappedBy="rentalObject", orphanRemoval=true)
     */
    private $rentalContracts;

    public function __construct()
    {
        $this->rentalContracts = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('%s. %s (%s, %s, %s)', $this->id, $this->name, $this->country, $this->city, $this->address);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|RentalContract[]
     */
    public function getRentalContracts(): Collection
    {
        return $this->rentalContracts;
    }

    public function addRentalContract(RentalContract $rentalContract): self
    {
        if (!$this->rentalContracts->contains($rentalContract)) {
            $this->rentalContracts[] = $rentalContract;
            $rentalContract->setRentalObject($this);
        }

        return $this;
    }

    public function removeRentalContract(RentalContract $rentalContract): self
    {
        if ($this->rentalContracts->removeElement($rentalContract)) {
            // set the owning side to null (unless already changed)
            if ($rentalContract->getRentalObject() === $this) {
                $rentalContract->setRentalObject(null);
            }
        }

        return $this;
    }
}

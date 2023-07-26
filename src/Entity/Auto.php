<?php

namespace App\Entity;

use App\Repository\AutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutoRepository::class)]
class Auto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $carmake = null;

    #[ORM\Column(length: 255)]
    private ?string $carmodel = null;

    #[ORM\Column]
    private ?int $caryear = null;

    #[ORM\Column(length: 255)]
    private ?string $coveragetype = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCarmake(): ?string
    {
        return $this->carmake;
    }

    public function setCarmake(string $carmake): static
    {
        $this->carmake = $carmake;

        return $this;
    }

    public function getCarmodel(): ?string
    {
        return $this->carmodel;
    }

    public function setCarmodel(string $carmodel): static
    {
        $this->carmodel = $carmodel;

        return $this;
    }

    public function getCaryear(): ?int
    {
        return $this->caryear;
    }

    public function setCaryear(int $caryear): static
    {
        $this->caryear = $caryear;

        return $this;
    }

    public function getCoveragetype(): ?string
    {
        return $this->coveragetype;
    }

    public function setCoveragetype(string $coveragetype): static
    {
        $this->coveragetype = $coveragetype;

        return $this;
    }
}

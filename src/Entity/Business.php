<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\BusinessRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessRepository::class)]
class Business
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameOfBusiness = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $policystartdate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $policyenddate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $information = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOfBusiness(): ?string
    {
        return $this->nameOfBusiness;
    }

    public function setNameOfBusiness(string $nameOfBusiness): static
    {
        $this->nameOfBusiness = $nameOfBusiness;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getPolicystartdate(): ?\DateTimeInterface
    {
        return $this->policystartdate;
    }

    public function setPolicystartdate(\DateTimeInterface $policystartdate): static
    {
        $this->policystartdate = $policystartdate;

        return $this;
    }

    public function getPolicyenddate(): ?\DateTimeInterface
    {
        return $this->policyenddate;
    }

    public function setPolicyenddate(\DateTimeInterface $policyenddate): static
    {
        $this->policyenddate = $policyenddate;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): static
    {
        $this->information = $information;

        return $this;
    }
}

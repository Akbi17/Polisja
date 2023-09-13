<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOfHouse = null;

    #[ORM\Column]
    private ?int $residentialArea = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $yearBuilt = null;

    #[ORM\Column(length: 255)]
    private ?string $constructionType = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $policyStartDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfHouse(): ?string
    {
        return $this->typeOfHouse;
    }

    public function setTypeOfHouse(string $typeOfHouse): static
    {
        $this->typeOfHouse = $typeOfHouse;

        return $this;
    }

    public function getResidentialArea(): ?int
    {
        return $this->residentialArea;
    }

    public function setResidentialArea(int $residentialArea): static
    {
        $this->residentialArea = $residentialArea;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYearBuilt(): ?int
    {
        return $this->yearbuilt;
    }

    public function setYearBuilt(int $yearBuilt): static
    {
        $this->yearbuilt = $yearBuilt;

        return $this;
    }

    public function getConstructionType(): ?string
    {
        return $this->constructionType;
    }

    public function setConstructionType(string $constructionType): static
    {
        $this->constructionType = $constructionType;

        return $this;
    }

    public function getPolicyStartDate(): ?\DateTimeInterface
    {
        return $this->policyStartDate;
    }

    public function setPolicyStartDate(\DateTimeInterface $policyStartDate): static
    {
        $this->policyStartDate = $policyStartDate;

        return $this;
    }
}

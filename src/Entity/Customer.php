<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
#[ApiResource]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private string $fullName;

    #[ORM\Column(nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?string $mobile = null;

    #[ORM\Column(nullable: true)]
    private ?string $address = null;

    #[ORM\Column(nullable: true)]
    private ?int $yearOfBuild = null;

    #[ORM\Column(nullable: true)]
    private ?float $deposit = null;

    #[ORM\Column(nullable: true)]
    private ?float $balance = null;

    #[ORM\OneToMany(targetEntity: WindowOrder::class, mappedBy: 'customer')]
    private ?Collection $order;

//    private Messages $messages;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTime $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->order = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getYearOfBuild(): ?int
    {
        return $this->yearOfBuild;
    }

    public function setYearOfBuild(?int $yearOfBuild): void
    {
        $this->yearOfBuild = $yearOfBuild;
    }

    public function getDeposit(): ?float
    {
        return $this->deposit;
    }

    public function setDeposit(?float $deposit): void
    {
        $this->deposit = $deposit;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(?float $balance): void
    {
        $this->balance = $balance;
    }

    public function getOrder(): ArrayCollection|Collection
    {
        return $this->order;
    }

    public function setOrder(?WindowOrder $order): void
    {
        $this->order = $order;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __toString()
    {
        return $this->getFullName();
    }
}
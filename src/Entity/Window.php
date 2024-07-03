<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WindowRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WindowRepository::class)]
#[ORM\Table(name: 'windows')]
#[ApiResource]
class Window
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private string $height;

    #[ORM\Column]
    private string $width;

    #[ORM\Column]
    private string $name;

    #[ORM\ManyToOne(targetEntity: WindowOrder::class, inversedBy: 'windows')]
    private WindowOrder $order;

    #[ORM\Column(nullable: true)]
    private ?string $notes;

     #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTime $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getOrder(): WindowOrder
    {
        return $this->order;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function setOrder(?WindowOrder $order): self
    {
        $this->order = $order;
        return $this;
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

    public function getMeasurement()
    {
        return $this->__toString();
    }
    
    public function __toString()
    {
        $data = $this->getName() . ' - H:' . $this->getHeight() .  '  X   W:' . $this->getWidth();

        if ($this->getNotes() !== null) {
            $data.= '  || Note: ' . $this->getNotes();
        }

        return $data;
    }
}
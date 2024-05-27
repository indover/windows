<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WindowOrderRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: WindowOrderRepository::class)]
#[ORM\Table]
#[ApiResource]
class WindowOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name;

    #[ORM\Column]
    private ?string $note;

    #[ORM\OneToMany(targetEntity: Window::class, mappedBy: 'order', cascade: ['persist'])]
    private Collection $windows;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class, inversedBy: "order")]
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id')]
    private ?OrderStatus $status;

//    #[ORM\ManyToOne(targetEntity: Installer::class)]
//    #[ORM\JoinColumn(name: 'installer_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
//    private ?Installer $installer;

    #[ORM\Column(type: 'datetime')]
    private ?DateTime $installationDate;

    #[ORM\Column]
    private float $price;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTime $updatedAt;
    
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->windows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    public function getWindows(): ?Collection
    {
        return $this->windows;
    }

    public function addWindow(Window $window): self
    {
        if (!$this->windows->contains($window)) {
            $this->windows[] = $window;
            $window->setOrder($this);
        }
        return $this;
    }

    public function removeWindow(Window $window): self
    {
        if ($this->windows->removeElement($window)) {
            // set the owning side to null (unless already changed)
            if ($window->getOrder() === $this) {
                $window->setOrder(null);
            }
        }
        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): void
    {
        $this->status = $status;
    }

//    public function getInstaller(): ?Installer
//    {
//        return $this->installer;
//    }
//
//    public function setInstaller(?Installer $installer): void
//    {
//        $this->installer = $installer;
//    }

    public function getInstallationDate(): ?DateTime
    {
        return $this->installationDate;
    }

    public function setInstallationDate(?DateTime $date): void
    {

        $this->installationDate = $date;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
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

    public function getNumberOfWindows(): int
    {
        return $this->getWindows()->count();
    }

    public function getNameOfWindows(): array
    {
        $data = [];
        foreach ($this->getWindows() as $window) {
            $data[] = $window->getName();
        }

        return $data;
    }

    public function getWindowsMeasurement()
    {
        $data = [];
        foreach ($this->getWindows() as $window) {
            $data[] = $window->getName() .' || '. $window->getWidth() .' || '. $window->getHeight() . ' ' . $window->getNotes();
        }

        return $data;
    }
}
<?php
//
//declare(strict_types=1);
//
//namespace App\Entity;
//
//use ApiPlatform\Metadata\ApiResource;
//use DateTime;
//use Doctrine\ORM\Mapping as ORM;
//use phpDocumentor\Reflection\Types\Integer;
//
//#[ORM\Entity]
//#[ORM\Table]
//#[ApiResource]
//class WindowPrice
//{
////    #[ORM\Id]
////    #[ORM\GeneratedValue]
////    #[ORM\Column]
////    private ?int $id = null;
////
////    #[ORM\Column]
////    private integer $height;
////
////    #[ORM\Column]
////    private integer $width;
////    #[ORM\Column]
////    private integer $price;
////
////    #[ORM\Column]
////    private integer $extraMoney;
////
////    #[ORM\ManyToOne(targetEntity: Installer::class)]
////    #[ORM\JoinColumn(name: 'installer_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
////    private Installer $installer;
////
////    #[ORM\Column(type: 'datetime')]
////    private DateTime $createdAt;
////
////    #[ORM\Column(type: 'datetime')]
////    private DateTime $updatedAt;
////
////    public function __construct()
////    {
////        $this->createdAt = new DateTime();
////        $this->updatedAt = new DateTime();
////    }
////
////    public function getId(): ?int
////    {
////        return $this->id;
////    }
////
////    public function getHeight(): int
////    {
////        return $this->height;
////    }
////
////    public function setHeight(int $height): void
////    {
////        $this->height = $height;
////    }
////
////    public function getWidth(): int
////    {
////        return $this->width;
////    }
////
////    public function setWidth(int $width): void
////    {
////        $this->width = $width;
////    }
////
////    public function getPrice(): int
////    {
////        return $this->price;
////    }
////
////    public function setPrice(int $price): void
////    {
////        $this->price = $price;
////    }
////
////    public function getExtraMoney(): int
////    {
////        return $this->extraMoney;
////    }
////
////    public function setExtraMoney(int $extraMoney): void
////    {
////        $this->extraMoney = $extraMoney;
////    }
////
////    public function getInstaller(): Installer
////    {
////        return $this->installer;
////    }
////
////    public function setInstaller(Installer $installer): void
////    {
////        $this->installer = $installer;
////    }
////
////    public function getCreatedAt(): DateTime
////    {
////        return $this->createdAt;
////    }
////
////    public function setCreatedAt(DateTime $createdAt): void
////    {
////        $this->createdAt = $createdAt;
////    }
////
////    public function getUpdatedAt(): DateTime
////    {
////        return $this->updatedAt;
////    }
////
////    public function setUpdatedAt(DateTime $updatedAt): void
////    {
////        $this->updatedAt = $updatedAt;
////    }
//}
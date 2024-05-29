<?php
//
//namespace App\Entity;
//
//use ApiPlatform\Metadata\ApiResource;
//use App\Repository\RoleRepository;
//use DateTime;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//
//#[ORM\Entity]
//#[ORM\Table]
//#[ApiResource]
//class Customer
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\Column]
//    private string $fullName;
//
//    #[ORM\Column]
//    private string $address;
//
//    #[ORM\Column]
//    private int $yearOfBuild;
//
//    #[ORM\Column]
//    private float $deposit;
//
//    #[ORM\Column]
//    private float $balance;
//
//    #[ORM\OneToMany(targetEntity: Window::class, mappedBy: 'order')]
//    private Collection $windows;
//
////    private Messages $messages;
//
//    #[ORM\Column(type: 'datetime')]
//    private DateTime $createdAt;
//
//    #[ORM\Column(type: 'datetime')]
//    private DateTime $updatedAt;
//
//    public function __construct()
//    {
//        $this->createdAt = new DateTime();
//        $this->updatedAt = new DateTime();
//    }
//}
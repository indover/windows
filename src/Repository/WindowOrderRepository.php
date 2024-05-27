<?php

namespace App\Repository;

use App\Entity\WindowOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

/**
 * @extends ServiceEntityRepository<WindowOrder>
 *
 * @method WindowOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method WindowOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method WindowOrder[]    findAll()
 * @method WindowOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WindowOrderRepository extends ServiceEntityRepository implements ObjectRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WindowOrder::class);
    }

    public function getCustomDetailById(int $id): WindowOrder
    {
        return $this->createQueryBuilder('w')
            ->select('w.installationDate', 'w.numberOfWindows', 'w.nameOfWindows', 'w.note')
            ->where('w.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

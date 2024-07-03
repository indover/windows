<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Role>
 *
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    public function getUniqueRoles(): array
    {
        $data = [];
        $array = $this->createQueryBuilder('r')
            ->select('r.role, r.name')->getQuery()->getResult();

        if (!empty($array)) {
            foreach ($array as $roles) {
                $index = key(reset($roles));
                $data[$roles['name']] = $roles['role'][$index];
            }
        }

        return $data;
    }
}

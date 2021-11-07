<?php

namespace App\Repository;

use App\Entity\UsSurnames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsSurnames|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsSurnames|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsSurnames[]    findAll()
 * @method UsSurnames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsSurnamesRepository extends abstractFCsEntity
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsSurnames::class);
    }
}

<?php

namespace App\Repository;

use App\Entity\RuSurnames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RuSurnames|null find($id, $lockMode = null, $lockVersion = null)
 * @method RuSurnames|null findOneBy(array $criteria, array $orderBy = null)
 * @method RuSurnames[]    findAll()
 * @method RuSurnames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuSurnamesRepository extends abstractFCsEntity
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RuSurnames::class);
    }
}

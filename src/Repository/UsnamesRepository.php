<?php

namespace App\Repository;

use App\Entity\Usnames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usnames|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usnames|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usnames[]    findAll()
 * @method Usnames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsnamesRepository extends abstractFCsEntity
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usnames::class);
    }
}

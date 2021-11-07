<?php

namespace App\Repository;

use App\Entity\RuNames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RuNames|null find($id, $lockMode = null, $lockVersion = null)
 * @method RuNames|null findOneBy(array $criteria, array $orderBy = null)
 * @method RuNames[]    findAll()
 * @method RuNames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuNamesRepository extends abstractFCsEntity
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RuNames::class);
    }
}

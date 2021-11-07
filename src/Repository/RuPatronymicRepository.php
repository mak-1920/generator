<?php

namespace App\Repository;

use App\Entity\RuPatronymic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RuPatronymic|null find($id, $lockMode = null, $lockVersion = null)
 * @method RuPatronymic|null findOneBy(array $criteria, array $orderBy = null)
 * @method RuPatronymic[]    findAll()
 * @method RuPatronymic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuPatronymicRepository extends abstractFCsEntity
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RuPatronymic::class);
    }
}

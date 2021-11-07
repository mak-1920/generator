<?php

namespace App\Repository;

use App\Entity\RuAddrSubjects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RuAddrSubjects|null find($id, $lockMode = null, $lockVersion = null)
 * @method RuAddrSubjects|null findOneBy(array $criteria, array $orderBy = null)
 * @method RuAddrSubjects[]    findAll()
 * @method RuAddrSubjects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuAddrSubjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RuAddrSubjects::class);
    }

    public function getAll() : array
    {
        return $this->createQueryBuilder('r')
            ->select('r.name', 'r.shortname', 'r.code', 'r.type')
            ->getQuery()
            ->getResult();
    }

    public function getSubjects(string $tpl) : array
    {
        return $this->createQueryBuilder('r')
            ->select('r.name', 'r.shortname', 'r.code', 'r.type')
            ->where('r.code LIKE :code')
            ->setParameter('code', $tpl)
            ->getQuery()
            ->getResult();
    }
}

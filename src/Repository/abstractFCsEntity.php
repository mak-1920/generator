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
abstract class abstractFCsEntity extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function getDataOfMale(?string $male, string $field): array
    {
        $query = $this->createQueryBuilder('r')
            ->select('r.id', "r.$field");
        if(!is_null($male))
            $query->where("r.gender = :male")
                ->setParameter('male', $male);
        return $query->getQuery()
            ->getResult();
    }

    public function getRandomPartsOfFCs(int $count, ?string $male, string $field): array
    {
        $ids = $this->getDataOfMale($male, $field);
        for ($i=0; $i < $count; $i++)
            $randomParts[$i] = $ids[rand(0, count($ids) - 1)][$field];
        return $randomParts;
    }
}
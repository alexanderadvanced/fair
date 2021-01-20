<?php

namespace App\Repository;

use App\Entity\RentalContract;
use App\Entity\RentalObject;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalContract[]    findAll()
 * @method RentalContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalContract::class);
    }

    public function findInBetween(RentalObject $rentalObject, DateTimeInterface $from, DateTimeInterface $to, $excludeObject = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.rentalObject = :rentalObject')
            ->andWhere('c.finishAt >= :from')
            ->andWhere('c.startAt <= :to')
            ->setParameters([
                'rentalObject' => $rentalObject,
                'from' => $from,
                'to' => $to,
            ]);

        if($excludeObject){
            $qb
                ->andWhere('c.id <> :excludeObject')
                ->setParameter('excludeObject', $excludeObject);
        }

        return $qb
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

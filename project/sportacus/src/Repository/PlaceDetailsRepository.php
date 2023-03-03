<?php

namespace App\Repository;

use App\Entity\PlaceDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceDetails>
 *
 * @method PlaceDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceDetails[]    findAll()
 * @method PlaceDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceDetails::class);
    }

    public function save(PlaceDetails $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaceDetails $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlaceDetails[] Returns an array of PlaceDetails objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlaceDetails
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

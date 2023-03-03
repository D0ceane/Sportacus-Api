<?php

namespace App\Repository;

use App\Entity\ManageAssociation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ManageAssociation>
 *
 * @method ManageAssociation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ManageAssociation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ManageAssociation[]    findAll()
 * @method ManageAssociation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManageAssociationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ManageAssociation::class);
    }

    public function save(ManageAssociation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ManageAssociation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ManageAssociation[] Returns an array of ManageAssociation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ManageAssociation
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\LesPatientsQueJeRecois;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LesPatientsQueJeRecois>
 *
 * @method LesPatientsQueJeRecois|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesPatientsQueJeRecois|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesPatientsQueJeRecois[]    findAll()
 * @method LesPatientsQueJeRecois[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesPatientsQueJeRecoisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesPatientsQueJeRecois::class);
    }

    public function save(LesPatientsQueJeRecois $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LesPatientsQueJeRecois $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LesPatientsQueJeRecois[] Returns an array of LesPatientsQueJeRecois objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LesPatientsQueJeRecois
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

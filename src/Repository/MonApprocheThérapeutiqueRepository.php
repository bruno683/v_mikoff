<?php

namespace App\Repository;

use App\Entity\MonApprocheThérapeutique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonApprocheThérapeutique>
 *
 * @method MonApprocheThérapeutique|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonApprocheThérapeutique|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonApprocheThérapeutique[]    findAll()
 * @method MonApprocheThérapeutique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonApprocheThérapeutiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonApprocheThérapeutique::class);
    }

    public function save(MonApprocheThérapeutique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MonApprocheThérapeutique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MonApprocheThérapeutique[] Returns an array of MonApprocheThérapeutique objects
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

//    public function findOneBySomeField($value): ?MonApprocheThérapeutique
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

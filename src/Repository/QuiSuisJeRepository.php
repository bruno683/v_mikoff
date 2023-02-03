<?php

namespace App\Repository;

use App\Entity\QuiSuisJe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuiSuisJe>
 *
 * @method QuiSuisJe|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuiSuisJe|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuiSuisJe[]    findAll()
 * @method QuiSuisJe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuiSuisJeRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, QuiSuisJe::class);
  }

  public function save(QuiSuisJe $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(QuiSuisJe $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  /**
   * @return QuiSuisJe[] Returns an array of QuiSuisJe objects
   */
  public function findByid($value): array
  {
    return $this->createQueryBuilder('q')
      ->andWhere('q.id = :val')
      ->setParameter('val', $value)
      ->orderBy('q.id', 'ASC')
      ->setMaxResults(1)
      ->getQuery()
      ->getResult();
  }

  //    public function findOneById($value): ?QuiSuisJe
  //    {
  //        return $this->createQueryBuilder('q')
  //            ->andWhere('q.id = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}

<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ProductosRepository extends ServiceEntityRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }
  public function findAllActive()
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT o FROM App:Productos o ORDER BY o.price ASC"
      )
      ->getResult();
  }
}

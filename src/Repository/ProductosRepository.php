<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityRepository;

class ProductosRepository extends EntityRepository
{
  public function findAllActive()
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT * FROM App:Productos ORDER BY price ASC"
      )
      ->getResult();
  }
}

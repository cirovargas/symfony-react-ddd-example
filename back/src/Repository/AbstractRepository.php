<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use DDD\Application\Repository\AbstractRepository as BaseAbstractRepository;

abstract class AbstractRepository extends ServiceEntityRepository implements BaseAbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        //        dd($registry);
        parent::__construct($registry, $this->getEntityClassName());
    }

    public function save($object): void
    {
        if (!is_object($object) || false === strstr(get_class($object), $this->getClassName())) {
            $exceptionMessage = sprintf('expects %s object, %s given', $this->getClassName(), gettype($object));
            if (is_object($object)) {
                $exceptionMessage = sprintf(
                    'expects %s object, %s given',
                    $this->getClassName(),
                    get_class($object)
                );
            }
            throw new \InvalidArgumentException($exceptionMessage);
        }

        $this->getEntityManager()->persist($object);
    }
}

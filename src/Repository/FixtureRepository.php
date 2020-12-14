<?php


namespace App\Repository;


use App\Entity\Fixture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FixtureRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Fixture::class);
    }

    public function persistAndFlush($fixture){
        $em = $this->getEntityManager();
        $em->persist($fixture);
        $em->flush();
    }

    public function remove($fixture){

        $em = $this->getEntityManager();
        $em->remove($fixture);

    }

}
<?php


namespace App\Repository;


use App\Entity\Sedes;
use App\Utils\Filters\HelperFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SedesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sedes::class);
    }

    //TODO Consultar si implementar un getAll simple con filtro por usuario o copiar lo de Repository para buscar por filtros
    //En teoría, la implementación final no requiere de busqueda por filtros.
}
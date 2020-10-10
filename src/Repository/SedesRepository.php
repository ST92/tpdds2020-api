<?php

namespace App\Repository;

use App\Entity\Sedes;
use App\Utils\Filters\HelperFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sedes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sedes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sedes[]    findAll()
 * @method Sedes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SedesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sedes::class);
    }

    /**
     * Busca los registros para la grilla
     *
     * @param array $filters
     * @param array $operators
     * @param array|null $order_by
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return array
     */
    public function findByGrid($filters, $operators, $order_by, $limit, $offset)
    {
        // armo los filtros
        $filterArray = [];
        $paramsArray = [];
        $joinWithArray = [];

        foreach ($filters as $campo => $valor) {
            switch ($campo) {
                case 'id';
                    HelperFilter::makeNumeric('s', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'usuario.id';
                    $joinWithArray[] = 'JOIN s.usuario u ';
                    HelperFilter::makeId('u', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'deporte.id';
                    $joinWithArray[] = 'JOIN s.deporte d ';
                    HelperFilter::makeId('d', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
            }
        }

        // armo el criterio de orden
        $orderByArray = [];
        foreach ($order_by as $campo => $direccion) {
            switch ($campo) {
                case 'id';
                    $orderByArray[] = 's.id ' . $direccion;
                    break;
                case 'usuario.id';
                    if (!in_array('JOIN s.usuario u ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN s.usuario u ';
                    }
                    $orderByArray[] = 'u.id ' . $direccion;
                    break;
                case 'deporte.id';
                    if (!in_array('JOIN s.estado d ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN s.estado d ';
                    }
                    $orderByArray[] = 'd.id ' . $direccion;
                    break;
            }
        }

        $where = '';
        if (!empty($filterArray)) {
            $where = 'WHERE ' . implode(' AND ', $filterArray);
        }

        $orderByStr = '';
        if (!empty($orderByArray)) {
            $orderByStr = ' ORDER BY ' . implode(' , ', $orderByArray);
        }

        $joinWithStr = '';
        if (!empty($joinWithArray)) {
            $joinWithStr = '' . implode(' ', $joinWithArray);
        }

        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT e FROM App:Sedes d $joinWithStr $where $orderByStr"
            )
            ->setParameters($paramsArray)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return $query->getResult();
    }

    /**
     * Cuenta la cantidad de registros según el filtro
     *
     * @param $filters
     * @param $operators
     *
     * @return integer
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countByGrid($filters, $operators)
    {
        // armo los filtros
        $filterArray = [];
        $paramsArray = [];
        $joinWithArray = [];

        foreach ($filters as $campo => $valor) {
            switch ($campo) {
                case 'id';
                    HelperFilter::makeNumeric('s', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'usuario.id';
                    $joinWithArray[] = 'JOIN s.usuario u ';
                    HelperFilter::makeId('u', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'deporte.id';
                    $joinWithArray[] = 'JOIN s.deporte d ';
                    HelperFilter::makeId('d', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
            }
        }

        $where = '';
        if (!empty($filterArray)) {
            $where = 'WHERE ' . implode(' AND ', $filterArray);
        }

        $joinWithStr = '';
        if (!empty($joinWithArray)) {
            $joinWithStr = '' . implode(' ', $joinWithArray);
        }

        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT(s.id) FROM App:Sedes s $joinWithStr $where "
            )
            ->setParameters($paramsArray);

        return $query->getSingleScalarResult();
    }
}

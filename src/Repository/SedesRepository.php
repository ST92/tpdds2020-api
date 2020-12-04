<?php

namespace App\Repository;

use App\Entity\Sedes;
use App\Utils\Filters\HelperFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;
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
    //TODO Eliminar si el otro funciona bien
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
                case 'usuarioId.id';
                    $joinWithArray[] = 'JOIN s.usuarioId u ';
                    HelperFilter::makeId('u', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'deporte.id';
                    $joinWithArray[] = 'INNER JOIN App:Deporte d ';
                    $filterArray[] = 'd.id IN (:' . 's.listaDeportes)';
                    $paramsArray['d.id'] = $valor;
                    //HelperFilter::makeId('d', 'id', $valor, $operators, $filterArray, $paramsArray);
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
                case 'usuarioId.id';
                    if (!in_array('JOIN s.usuarioId u ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN s.usuarioId u ';
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
                "SELECT s FROM App:Sedes s $joinWithStr $where $orderByStr"
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
     * @throws NoResultException
     * @throws NonUniqueResultException
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
                case 'usuarioId.id';
                    $joinWithArray[] = 'JOIN s.usuarioId u ';
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


    public function findSedesPorDeporte($idUsuario, $idDeporte){

        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('App:Sedes', 's');
        $rsm->addFieldResult('s', 'id', 'id');
        $rsm->addFieldResult('s', 'codigo', 'codigo');
        $rsm->addFieldResult('s', 'nombre', 'nombre');
        $rsm->addFieldResult('s', 'descripcion', 'descripcion');

        //$rsm->addJoinedEntityResult('App:Deporte' , 'd', 's', 'deporte');
        //$rsm->addFieldResult('d', 'id', 'id');


        /*$sql = 'SELECT * FROM sedes s ' .
            'INNER JOIN sedesdeporte sd ON s.id = sd.sedes_id '.
            'INNER JOIN deporte d ON sd.deporte_id = d.id '.
            'WHERE s.usuario_id = ?';*/

        $sql = 'SELECT s.id, s.codigo, s.descripcion, s.nombre FROM sedes s ' .
            'INNER JOIN sedesdeporte sd ON s.id = sd.sedes_id '.
            'INNER JOIN deporte d ON sd.deporte_id = ? '.
            'WHERE s.usuario_id = ?';

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $idDeporte);
        $query->setParameter(2, $idUsuario);


        return $query->getResult();


    }
    /*public function findBy(){
        <?php
        // Equivalent DQL query: "select u from User u where u.name=?1"
        // User owns no associations.
        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('User', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'name');

        $query = $this->_em->createNativeQuery('SELECT id, name FROM users WHERE name = ?', $rsm);
        $query->setParameter(1, 'romanb');

        $users = $query->getResult();

            $rsm = new ResultSetMapping;
        $rsm->addEntityResult('User', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'name');
        $rsm->addJoinedEntityResult('Address' , 'a', 'u', 'address');
        $rsm->addFieldResult('a', 'address_id', 'id');
        $rsm->addFieldResult('a', 'street', 'street');
        $rsm->addFieldResult('a', 'city', 'city');

        $sql = 'SELECT u.id, u.name, a.id AS address_id, a.street, a.city FROM users u ' .
               'INNER JOIN address__user j ON u.id = j.user '.
               'INNER JOIN address a ON a.id = j.address '.
               'WHERE u.name = ?';
        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, 'romanb');

        $users = $query->getResult();
    }*/
}

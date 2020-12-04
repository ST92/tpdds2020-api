<?php


namespace App\Repository;

use App\Entity\Competencia;
use App\Utils\Filters\HelperFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CompetenciaRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Competencia::class);
    }

    public function persistAndFlush($competencia){
        $em = $this->getEntityManager();
        $em->persist($competencia);
        $em->flush();
    }


    /**
     * @param $nombre
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByNombre($nombre)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT c FROM App:Competencia c WHERE c.nombre = :nombre "
            );
        $query->setParameters(['nombre' => $nombre]);

        return $query->getOneOrNullResult();
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
                    HelperFilter::makeNumeric('c', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'nombre';
                    HelperFilter::makeString('c', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'deporteId';
                    $joinWithArray[] = 'JOIN c.deporteId d ';
                    HelperFilter::makeId('d', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'tipoCompetenciaId';
                    $joinWithArray[] = 'JOIN c.tipoCompetenciaId tc ';
                    HelperFilter::makeId('tc', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'estadoCompetenciaId';
                    $joinWithArray[] = 'JOIN c.estadoCompetenciaId ec ';
                    HelperFilter::makeId('ec', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'usuarioId';
                    $joinWithArray[] = 'JOIN c.usuarioId u ';
                    HelperFilter::makeId('u', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;

            }
        }

        // armo el criterio de orden
        $orderByArray = [];
        foreach ($order_by as $campo => $direccion) {
            switch ($campo) {
                case 'id';
                    $orderByArray[] = 'c.id ' . $direccion;
                    break;
                case 'nombre';
                    $orderByArray[] = 'c.nombre ' . $direccion;
                    break;
                case 'deporteId.id';
                    if (!in_array('JOIN c.deporteId d ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN c.deporteId d ';
                    }
                    $orderByArray[] = 'd.id ' . $direccion;
                    break;
                case 'tipoCompetenciaId.id';
                    if (!in_array('JOIN c.tipoCompetenciaId tc ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN c.tipoCompetenciaId tc ';
                    }
                    $orderByArray[] = 'tc.id ' . $direccion;
                    break;
                case 'estadoCompetenciaId.id';
                    if (!in_array('JOIN c.estadoCompetenciaId ec ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN c.estadoCompetenciaId ec ';
                    }
                    $orderByArray[] = 'ec.id ' . $direccion;
                    break;
                case 'usuarioId.id';
                    if (!in_array('JOIN c.usuarioId u ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN c.usuarioId u ';
                    }
                    $orderByArray[] = 'u.id ' . $direccion;
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
                "SELECT c FROM App:Competencia c $joinWithStr $where $orderByStr"
            )
            ->setParameters($paramsArray)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return $query->getResult();
    }

}
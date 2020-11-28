<?php


namespace App\Repository;



use App\Entity\Participante;
use App\Utils\Filters\HelperFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ParticipanteRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Participante::class);
    }

    public function persistAndFlush($participante){
        $em = $this->getEntityManager();
        $em->persist($participante);
        $em->flush();
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
                    HelperFilter::makeNumeric('p', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'nombre';
                    HelperFilter::makeString('p', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'email';
                    HelperFilter::makeString('p', $campo, $valor, $operators, $filterArray, $paramsArray);
                    break;
                case 'competenciaId';
                    $joinWithArray[] = 'JOIN p.competenciaId c ';
                    HelperFilter::makeId('c', 'id', $valor, $operators, $filterArray, $paramsArray);
                    break;
            }
        }

        // armo el criterio de orden
        $orderByArray = [];
        foreach ($order_by as $campo => $direccion) {
            switch ($campo) {
                case 'id';
                    $orderByArray[] = 'p.id ' . $direccion;
                    break;
                case 'nombre';
                    $orderByArray[] = 'p.nombre ' . $direccion;
                    break;
                case 'email';
                    $orderByArray[] = 'p.email ' . $direccion;
                    break;
                case 'competenciaId';
                    if (!in_array('JOIN p.competenciaId c ', $joinWithArray)) {
                        $joinWithArray[] = 'JOIN p.competenciaId c ';
                    }
                    $orderByArray[] = 'c.id ' . $direccion;
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
                "SELECT p FROM App:Participante p $joinWithStr $where $orderByStr"
            )
            ->setParameters($paramsArray)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return $query->getResult();
    }





}
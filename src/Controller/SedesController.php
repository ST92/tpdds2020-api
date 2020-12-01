<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\Deporte;
use App\Entity\EstadoCompetencia;
use App\Entity\Sedes;
use App\Entity\SedesCompetencia;
use App\Entity\Usuario;
use App\Form\CompetenciaType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @RouteResource("Sedes", pluralize=false)
 */
class SedesController extends FOSRestController
{

    /**
     * Devuelve las sedes
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @View()
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="100", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     * @QueryParam(name="operators", nullable=true, description="Operator by fields. Must be an array ie. &operators[id]=>")
     *
     * @return array
     *
     *
     */
    private function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $order_by = !is_null($paramFetcher->get('order_by')) ? $paramFetcher->get('order_by') : array();
        $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();
        $operators = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('operators') : array();

        $em = $this->getDoctrine()->getManager();

        return [
            'sedes' => $em->getRepository(Sedes::class)->findByGrid($filters, $operators, $order_by, $limit, $offset),
        ];
    }

    /**
     * Devuelve los deportes ordenados alfabeticamente
     *
     * @View()
     *
     * @return array|object[]
     */
    public function cgetDeporteAction(){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository(Deporte::class)->findBy([],['nombre' => 'ASC']);
    }

    /**
     * Devuelve una sede específica
     *
     * @param Sedes $sedes
     *
     * @return Sedes
     *
     * @View()
     */
    public function getAction(Sedes $sedes)
    {
        return $sedes;
    }

    /**
     * Devuelve una sede específica
     *
     * @param $idUsuario
     * @param $idDeporte
     * @return array
     *
     * @View()
     */
    public function getSedespordeporteAction($idUsuario, $idDeporte){

        $em = $this->getDoctrine()->getManager();

        return [
            'sedes' => $em->getRepository(Sedes::class)->findSedesPorDeporte($idUsuario, $idDeporte),
        ];
    }
}
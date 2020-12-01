<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\Encuentro;
use App\Entity\EstadoCompetencia;
use App\Entity\Fixture;
use App\Entity\Ronda;
use App\Entity\SedesCompetencia;
use App\Entity\TipoCompetencia;
use App\Entity\TipoPuntuacion;
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


/**
 * @RouteResource("Competencias", pluralize=false)
 */
class CompetenciaController extends FOSRestController
{

    /**
     * CU004 - Alta de Competencia
     *
     * @param Request $request
     * @return FormInterface|Competencia
     * @View()
     * @throws
     */
    public function postAction(Request $request){


        $em = $this->getDoctrine()->getManager();

        $competencia = new Competencia();

        $competenciaRepository = $em->getRepository(Competencia::class);

        $competencia->setEstadoCompetenciaId($em->getReference(EstadoCompetencia::class,EstadoCompetencia::CREADA));

        $objForm = $this->createForm(CompetenciaType::class, $competencia, ['em' => $em]);
        $objForm->handleRequest($request);

        if ($objForm->isSubmitted() && $objForm->isValid()) {

            foreach ($competencia->getListaSedesCompetencia() as $sedes_competencia){
                $sedes_competencia->setCompetenciaId($competencia);
            }

            $competenciaRepository->persistAndFlush($competencia);

            return $competencia;
        }

        return $objForm;
    }



    /**
     *
     * CU003 - Listar Competencias
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
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $order_by = !is_null($paramFetcher->get('order_by')) ? $paramFetcher->get('order_by') : array();
        $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();
        $operators = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('operators') : array();

        $em = $this->getDoctrine()->getManager();

        return [
            'items' => $em->getRepository(Competencia::class)->findByGrid($filters, $operators, $order_by, $limit, $offset),
        ];
    }


    /** CU20 - VER COMPETENCIA
    */
    /**
     * Retorna una competencia dado un ID específico
     *
     * @param Competencia $competencia
     * @return Competencia
     * @View()
     */
    public function getAction(Competencia $competencia){

        return $competencia;

    }



    /** LISTAS DESPLEGABLES */

    /**
     * Devuelve los tipos de competencia ordenados alfabeticamente
     *
     * @View()
     *
     * @return array|object[]
     */
    public function cgetTipocompetenciaAction(){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository(TipoCompetencia::class)->findBy([],['nombre' => 'ASC']);
    }


    /**
     * Devuelve los tipos de puntuación ordenados alfabeticamente
     *
     * @View()
     *
     * @return array|object[]
     */
    public function cgetTipopuntuacionAction(){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository(TipoPuntuacion::class)->findBy([],['nombre' => 'ASC']);
    }




}
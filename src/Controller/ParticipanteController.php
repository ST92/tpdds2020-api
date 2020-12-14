<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\EstadoCompetencia;
use App\Entity\Fixture;
use App\Entity\Participante;
use App\Form\CompetenciaType;
use App\Form\ParticipanteType;
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
 * @RouteResource("Participantes", pluralize=false)
 */
class ParticipanteController extends FOSRestController{

    /**
     * CU008 - Listar Participantes
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
            'items' => $em->getRepository(Participante::class)->findByGrid($filters, $operators, $order_by, $limit, $offset),
        ];
    }


    /**
     * CU009 - Alta de Participante
     *
     * @param Request $request
     * @return FormInterface|Participante
     * @View()
     * @throws
     */
    public function postAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $participante = new Participante();

        $participanteRepository = $em->getRepository(Participante::class);

        $objForm = $this->createForm(ParticipanteType::class, $participante, ['em' => $em]);
        $objForm->handleRequest($request);

        if ($objForm->isSubmitted() && $objForm->isValid()) {

            $estadoCompetencia = $participante->getCompetenciaId()->getEstadoCompetenciaId();
            $competencia = $participante->getCompetenciaId();

            if($estadoCompetencia->getId()==EstadoCompetencia::CREADA || $estadoCompetencia->getId()==EstadoCompetencia::PLANIFICADA){

                //Elimino el fixture
                if($competencia->getFixtureId()!=null){
                    $em->getRepository(Fixture::class)->remove($competencia->getFixtureId());
                    $competencia->setFixtureId(null); //Esta línea evita errores.
                }

                //Vuelvo la competencia a estado CREADA.
                $participante->getCompetenciaId()->setEstadoCompetenciaId($em->getReference(EstadoCompetencia::class,EstadoCompetencia::CREADA));
                $participanteRepository->persistAndFlush($participante);

                return $participante;

            }

            throw $this->createNotFoundException('No se pudo dar de alta al participante. La competencia ha finalidado o ya está en disputa');

        }

        return $objForm;
    }








}
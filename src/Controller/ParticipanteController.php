<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\EstadoCompetencia;
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
     * Crear nuevo participante
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

            if($estadoCompetencia->getId()==EstadoCompetencia::CREADA || $estadoCompetencia->getId()==EstadoCompetencia::PLANIFICADA){

                $participanteRepository->persistAndFlush($participante);

                //TODO Agregar acá validación por email existente.

                return $participante;

            }

            return null; //TODO Ver esto. Diagrama de secuencias arroja excepción

        }

        return $objForm;
    }




    /** VALIDACIONES DE PARTICIPANTE PARA EL FRONT*/

    /**
     * Valida que el nombre sea único
     *
     * @param Request $request
     * @return Participante|array
     * @View()
     */
    public function esnombreunicoAction(Request $request){

        $em = $this->getDoctrine()->getManager();


        /* @var Participante $participante*/
        $participante = $em->getRepository(Participante::class)->findOneByNombre($request->query->get('nombre'));

        //TODO Consultar como se prueba esto.
        if ($participante) {

            if ($participante->getId() == $request->query->get('id')) { // SE COMPARA ASI MISMO
                return ['unico' => true];
            }
            return ['unico' => false];
        }
        return ['unico' => true];
    }


    /**
     * Valida que el email sea único
     *
     * @param Request $request
     * @return Participante|array
     * @View()
     */
    public function esemailunicoAction(Request $request){

        $em = $this->getDoctrine()->getManager();


        /* @var Participante $participante*/
        $participante = $em->getRepository(Participante::class)->findOneByEmail($request->query->get('email'));

        //TODO Consultar como se prueba esto.
        if ($participante) {

            if ($participante->getId() == $request->query->get('id')) { // SE COMPARA ASI MISMO
                return ['unico' => true];
            }
            return ['unico' => false];
        }
        return ['unico' => true];
    }


}
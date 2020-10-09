<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\EstadoCompetencia;
use App\Form\CompetenciaType;
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
     * Crear nueva competencia
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

        $competencia->setEstadoCompetenciaId($em->getReference(EstadoCompetencia::class,1));

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

    //TODO Implementar un cgetTipoCompetencia - CU004 - Alta Competencia
    //TODO Implementar un cgetTipoPuntuacion - CU004 - Alta Competencia


}
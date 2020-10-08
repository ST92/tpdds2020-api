<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\EstadoCompetencia;
use App\Entity\SedesCompetencia;
use App\Form\CompetenciaType;
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
 * @RouteResource("SedesCompetencias", pluralize=false)
 */
class SedesCompetenciaController extends FOSRestController
{

    /**
     * Devuelve una sedecompetencia
     *
     * @param SedesCompetencia $sedesCompetencia
     *
     * @return SedesCompetencia
     *
     * @View()
     */
    public function getAction(SedesCompetencia $sedesCompetencia){
        return $sedesCompetencia;
    }


}
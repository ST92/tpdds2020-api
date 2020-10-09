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
     * Devuelve una sedecompetencia
     *
     * @param Sedes $sedesCompetencia
     *
     * @return Sedes
     *
     * @View()
     */
    public function getAction(Sedes $sedesCompetencia)
    {
        return $sedesCompetencia;
    }



    /**
     * Devuelve las sedes.
     * TODO Implementar para CU004 - Dar Alta Competencia.
     *
     */
    public function cgetAction()
    {

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



}
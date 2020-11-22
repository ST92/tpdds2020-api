<?php

namespace App\Controller;

use App\Entity\Competencia;
use App\Entity\EstadoCompetencia;
use App\Entity\TipoCompetencia;
use App\Entity\TipoPuntuacion;
use App\Form\CompetenciaType;
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





    /** VALIDACIONES DE COMPETENCIA PARA EL FRONT*/

    /**
     * Retorna una competencia dado un ID específico
     *
     * @param Request $request
     * @return Competencia|array
     * @View()
     */
    public function esnombreunicoAction(Request $request){

        $em = $this->getDoctrine()->getManager();


        /* @var Competencia $competencia*/
        $competencia = $em->getRepository(Competencia::class)->findOneByNombre($request->query->get('nombre'));

        //TODO Consultar como se prueba esto.
        if ($competencia) {

            if ($competencia->getId() == $request->query->get('id')) { // SE COMPARA ASI MISMO
                return ['unico' => true];
            }
            return ['unico' => false];
        }
        return ['unico' => true];
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
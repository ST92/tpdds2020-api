<?php


namespace App\Controller;


use App\Entity\Competencia;
use App\Entity\Encuentro;
use App\Entity\Fixture;
use App\Entity\Sedes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @RouteResource("Fixtures", pluralize=false)
 */
class FixtureController extends FOSRestController{


    /**
     * CU20 - Ver Competencia.
     *
     * Retorna la lista de los próximos eventos. Para el CU20, solo considerar el campo count.
     *
     * @param
     * @return
     * @View()
     * @throws
     */
    public function getProximosEncuentros(Competencia $competencia){

        /*
         * TODO Consultar este caso de uso.
         * $em = $this->getDoctrine()->getManager();

        $fixtureRepository = $em->getRepository(Fixture::class);

        $listaProximosEncuentros = $em->getRepository(Encuentro::class)->

        return [
            'proximosEventos' => ,
            'count' => ,
        ];*/

    }

}
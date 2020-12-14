<?php


namespace App\Controller;


use App\Entity\Competencia;
use App\Entity\Encuentro;
use App\Entity\EstadoCompetencia;
use App\Entity\Fixture;
use App\Entity\Ronda;
use App\Entity\Sedes;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @RouteResource("Fixtures", pluralize=false)
 */
class FixtureController extends FOSRestController{


    /**
     * CU017 - Generar Fixture
     *
     * @param Competencia $competencia
     * @View()
     */
    public function generarfixtureAction(Competencia $competencia){

        $em = $this->getDoctrine()->getManager();
        $fixtureRepository = $em->getRepository(Fixture::class);


        if($competencia!=null){

            if(!($competencia->getEstadoCompetenciaId()->getId()==EstadoCompetencia::CREADA ||$competencia->getEstadoCompetenciaId()->getId()==EstadoCompetencia::PLANIFICADA)){
                throw $this->createNotFoundException('No se pudo generar el Fixture. La competencia se encuentra en disputa o ha terminado.');
            }

            //Elimina el Fixture anterior.
            if($competencia->getFixtureId()!=null){
                $em->getRepository(Fixture::class)->remove($competencia->getFixtureId());
                $competencia->setFixtureId(null);
            }

            $listaParticipantes = $competencia->getListaParticipantes();
            $sedes = $competencia->getListaSedesCompetencia();

            //Fixture para cantidad de participantes PAR
            if($listaParticipantes->count() >1 && $listaParticipantes->count()%2==0){

                $disponibilidadTotal = $this->calcularDisponibilidadTotal($sedes);
                $cantidadEncuentrosPorRonda = $listaParticipantes->count()/2;
                $cantidadRondas = $listaParticipantes->count()-1;

                if($cantidadRondas*$cantidadEncuentrosPorRonda > $disponibilidadTotal){
                    //Si no alcanza la disponibilidad para todas las rondas
                    throw $this->createNotFoundException('No se pudo generar el Fixture. La disponibilidad total de sedes no es suficiente.');
                }


                $encuentros[$cantidadRondas][$cantidadEncuentrosPorRonda] = new Encuentro();

                $this->generarFixtureNroPar($encuentros, $cantidadRondas,$cantidadEncuentrosPorRonda, $listaParticipantes);


            }else{

                //Fixture para cantidad de participantes IMPAR
                if($listaParticipantes->count() >1 && $listaParticipantes->count()%2!=0){

                    $disponibilidadTotal = $this->calcularDisponibilidadTotal($sedes);
                    $cantidadEncuentrosPorRonda = floor($listaParticipantes->count()/2);
                    $cantidadRondas = $listaParticipantes->count();

                    if($cantidadRondas*$cantidadEncuentrosPorRonda > $disponibilidadTotal){
                        //Si no alcanza la disponibilidad para todas las rondas
                        throw $this->createNotFoundException('No se pudo generar el Fixture. La disponibilidad total de sedes no es suficiente.');
                    }


                    $encuentros[$cantidadRondas][$cantidadEncuentrosPorRonda] = new Encuentro();

                    $this->generarFixtureNroImpar($encuentros, $cantidadRondas,$cantidadEncuentrosPorRonda, $listaParticipantes);

                }else{

                    //No hay participantes
                    throw $this->createNotFoundException('No se pudo generar el Fixture. La competencia requiere de al menos 2 participantes registrados');

                }

            }

            //SI llega acá es porque se generaron los fixtures
            //Se arma el fixture y se le asignan las sedes
            $fixture = $this->armadoFixture($encuentros, $sedes, $cantidadRondas, $cantidadEncuentrosPorRonda);

            $competencia->setFixtureId($fixture);
            $competencia->setEstadoCompetenciaId($em->getReference(EstadoCompetencia::class,EstadoCompetencia::PLANIFICADA));

            $fixtureRepository->persistAndFlush($fixture);

        }
        else{

            throw $this->createNotFoundException('No se pudo generar el Fixture. La competencia no existe');

        }
    }

    /**
     * Recibe una lista de SedesCompetencia y retorna la disponibilidad total
     *
     * @param $sedes
     * @return int
     */
    private function calcularDisponibilidadTotal($sedes){

        $cantidadTotal = 0;

        foreach ($sedes as $sede){
            $cantidadTotal+=$sede->getDisponibilidad();
        }
        return $cantidadTotal;
    }

    /**
     * Recibe una matriz de Encuentro y la completa
     * @param $encuentros
     * @param $cantidadRondas
     * @param $cantidadEncuentrosPorRonda
     * @param $listaParticipantes
     * @return void
     */
    private function generarFixtureNroPar(&$encuentros, $cantidadRondas,$cantidadEncuentrosPorRonda, $listaParticipantes){

        for($i=0, $k=0; $i<$cantidadRondas; $i++){
            for ($j=0; $j<$cantidadEncuentrosPorRonda; $j++){
                $encuentros[$i][$j] = new Encuentro();
                $encuentros[$i][$j]->setParticipante1Id($listaParticipantes->get($k));
                $k++;

                if ($k==$cantidadRondas){
                    $k=0;
                }
            }
        }

        //j=0 siempre
        for($i=0, $j=0; $i<$cantidadRondas; $i++){
            if($i%2==0){
                $encuentros[$i][$j]->setParticipante2Id($listaParticipantes->last());
            }else{
                $encuentros[$i][$j]->setParticipante2Id($encuentros[$i][$j]->getParticipante1Id());
                $encuentros[$i][$j]->setParticipante1Id($listaParticipantes->last());
            }
        }
        $equipoMasAlto = ($listaParticipantes->count()-1)-1;

        for($i=0, $k=$equipoMasAlto; $i<$cantidadRondas; $i++){
            for ($j=1; $j<$cantidadEncuentrosPorRonda; $j++){
                $encuentros[$i][$j]->setParticipante2Id($listaParticipantes->get($k));
                $k--;

                if ($k==-1){
                    $k=$equipoMasAlto;
                }
            }
        }
    }

    /**
     * Recibe una matriz de Encuentro y la completa
     * @param $encuentros
     * @param $cantidadRondas
     * @param $cantidadEncuentrosPorRonda
     * @param $listaParticipantes
     * @return void
     */
    private function generarFixtureNroImpar(&$encuentros, $cantidadRondas, $cantidadEncuentrosPorRonda, $listaParticipantes){

        for ($i=0, $k=0; $i<$cantidadRondas; $i++){

            for($j=-1; $j<$cantidadEncuentrosPorRonda; $j++){

                if($j>=0){
                    $encuentros[$i][$j] = new Encuentro();
                    $encuentros[$i][$j]->setParticipante1Id($listaParticipantes->get($k));
                }
                $k++;

                if($k==$cantidadRondas){
                    $k=0;
                }
            }
        }

        $equipoMasAlto = $listaParticipantes->count()-1;

        for($i=0, $k=$equipoMasAlto; $i<$cantidadRondas; $i++){

            for ($j=0; $j<$cantidadEncuentrosPorRonda; $j++){
                $encuentros[$i][$j]->setParticipante2Id($listaParticipantes->get($k));
                $k--;

                if($k==-1){
                    $k=$equipoMasAlto;
                }

            }
        }

    }

    /**
     * Recibe una matriz de Encuentro y la completa
     * @param $encuentros
     * @param $sedes
     * @param $cantidadRondas
     * @param $cantidadEncuentrosPorRonda
     * @return Fixture
     */
    private function armadoFixture($encuentros, $sedes, $cantidadRondas, $cantidadEncuentrosPorRonda){

        $disponibilidad=0;
        $siguienteSede = 0;

        $fixture = new Fixture();


        for ($i=0; $i<$cantidadRondas; $i++){

            $ronda = new Ronda();
            $ronda->setNumero($i);

            for($j=0; $j<$cantidadEncuentrosPorRonda; $j++){

                if($disponibilidad==0){

                    $sede = $sedes->get($siguienteSede); //Obtengo la proxima sede a asignar
                    $disponibilidad=$sede->getDisponibilidad();
                    //$sedes->remove(0);
                    $siguienteSede++;
                }

                $encuentros[$i][$j]->setSedesId($sede->getSedesId());
                $encuentros[$i][$j]->setRondaId($ronda);

                $disponibilidad--;

                $ronda->getListaEncuentros()->add($encuentros[$i][$j]);

            }

            //$fecha= $this->calcularFecha();

            $fixture->getListaRondas()->add($ronda);
            $ronda->setFixtureId($fixture);

        }

        return $fixture;

    }



    /**
     * CU20 - Ver Competencia.
     *
     * Retorna la lista de los próximos eventos. Para el CU20, solo considerar el campo count.
     *
     * @param Competencia $competencia
     * @return int
     * @View()
     */
    public function getproximosencuentrosAction(Competencia $competencia){


        /*
         * Sólo si la competencia está planificada o en disputa
         *
         * La lógica a realizar es la siguiente:
         *  -Busco la ultima ronda que está en disputa actualmente (con los encuenntros)
         *  Lo hago revisando el campo de resultados.
         *
         * - En base a eso, retorno uno de los siguientes resultados posibles:
         *      -Cantidad de encuentros pendientes para la ronda actualmente en disputa
         *      -Cantidad de encuentros de la proxima ronda si la actual ya ha finalizado sus encuentros
         * */


        if(!($competencia->getEstadoCompetenciaId()->getId()==EstadoCompetencia::PLANIFICADA || $competencia->getEstadoCompetenciaId()->getId()==EstadoCompetencia::EN_DISPUTA)){
            return 0;
        }

        $listaRondas = $competencia->getFixtureId()->getListaRondas();

        if($listaRondas==null || $listaRondas->isEmpty()){
            return 0;
        }

        $i=0; //Itera sobre la lista de rondas
        $encontrado = false;
        $nroRondaPendiente=0;
        $nroEncuentro = 0;

        while($i<$listaRondas->count() && !$encontrado){

            $j=0; //Itera sobre lista de encuentros de la ronda i
            $listaEncuentros = $listaRondas->get($i)->getListaEncuentros();

            //Busco el encuentro que no tenga un resultado cargado
            while($j<$listaEncuentros->count() && !$encontrado){

                if($listaEncuentros->get($j)->getListaResultados()==null ||
                    $listaEncuentros->get($j)->getListaResultados()->isEmpty()){
                    $nroRondaPendiente=$i;
                    $nroEncuentro=$j;
                    $encontrado=true;
                }

                $j++;

            }

            $i++;

        }

        return $listaRondas->get($nroRondaPendiente)->getListaEncuentros()->count() - $nroEncuentro;

    }

    /**
     * @param Fixture $fixture
     * @return Fixture
     * @View()
     */
    public function getAction(Fixture $fixture){

        return $fixture;
    }

}
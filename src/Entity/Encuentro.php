<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Encuentro
 *
 * @ORM\Table(name="encuentro", indexes={@ORM\Index(name="participante_fk_2", columns={"participante2_id"}), @ORM\Index(name="sedes_fk_1", columns={"sedes_id"}), @ORM\Index(name="encuentro_fk_1", columns={"encuentro_perdedor_id"}), @ORM\Index(name="encuentro_fk_2", columns={"encuentro_ganador_id"}), @ORM\Index(name="participante_fk_1", columns={"participante1_id"}), @ORM\Index(name="participante_fk_3", columns={"ganador_id"}), @ORM\Index(name="ronda_fk_1", columns={"ronda_id"})})
 * @ORM\Entity
 */
class Encuentro
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="encuentro_empatado", type="boolean", nullable=false)
     */
    private $encuentroEmpatado;

    /**
     * @var bool
     *
     * @ORM\Column(name="asistencia_participante_1", type="boolean", nullable=false)
     */
    private $asistenciaParticipante1;

    /**
     * @var bool
     *
     * @ORM\Column(name="asistencia_participante_2", type="boolean", nullable=false)
     */
    private $asistenciaParticipante2;


    /**
     * @var Participante
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participante1_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $participante1Id;

    /**
     * @var Participante
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participante2_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $participante2Id;

    /**
     * @var Participante
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ganador_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $ganadorId;


    /**
     * @var Sedes
     *
     * @ORM\ManyToOne(targetEntity="Sedes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sedes_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $sedesId;


    /**
     * @var Ronda
     *
     * @ORM\ManyToOne(targetEntity="Ronda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ronda_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $rondaId;

    //TODO Creo que esto sería unidireccional. Buscar una asociación consigo misma
    /**
     * @var Encuentro
     *
     * @ORM\OneToOne(targetEntity="Encuentro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_perdedor_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $encuentroPerdedorId;

    /**
     * @var Encuentro
     *
     * @ORM\OneToOne(targetEntity="Encuentro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_ganador_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $encuentroGanadorId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Resultado", mappedBy="encuentroId", cascade={"persist", "remove"})
     */
    private $listaResultados;

}

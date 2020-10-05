<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Competencia
 *
 * @ORM\Table(name="competencia", indexes={@ORM\Index(name="usuario_fk_1", columns={"usuario_id"}), @ORM\Index(name="tipo_competencia_fk_1", columns={"tipo_competencia_id"}), @ORM\Index(name="tipo_puntuacion_fk_1", columns={"tipo_puntuacion_id"}), @ORM\Index(name="fixture_fk_1", columns={"fixture_id"}), @ORM\Index(name="estado_competencia_fk_1", columns={"estado_competencia_id"}), @ORM\Index(name="deporte_fk_1", columns={"deporte_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CompetenciaRepository")
 *
 * @UniqueEntity(
 *     fields={"nombre"},
 *     message="El nombre de competencia ya existe"
 * )
 */
class Competencia
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;
    //TODO agregar restricción en base de dato del unique.
    /**
     * @var string
     *
     * @ORM\Column(name="reglamento", type="string", length=1000, nullable=true)
     */
    private $reglamento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permite_empate", type="boolean", nullable=false)
     */
    private $permiteEmpate;

    /**
     * @var int
     *
     * @ORM\Column(name="ptos_ganado", type="integer", nullable=false)
     */
    private $ptosGanado;

    /**
     * @var int
     *
     * @ORM\Column(name="ptos_empate", type="integer", nullable=false)
     */
    private $ptosEmpate;

    /**
     * @var int
     *
     * @ORM\Column(name="ptos_presentacion", type="integer", nullable=false)
     */
    private $ptosPresentacion;

    /**
     * Cuando elige tipo de puntuación PUNTUACION = 2;
     * @var int
     *
     * @ORM\Column(name="ptos_ausencia", type="integer", nullable=true)
     */
    private $ptosAusencia;

    /**
     * Cuando elige tipo de puntuación SETS = 1;
     * @var int
     *
     * @ORM\Column(name="cantidad_sets", type="integer", nullable=true)
     */
    private $cantidadSets;


    /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha_baja", type="date", nullable=true)
     */
    private $fechaBaja;


    /**
     * @var EstadoCompetencia
     *
     * @ORM\ManyToOne(targetEntity="EstadoCompetencia", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_competencia_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $estadoCompetenciaId;

    /**
     * @var TipoCompetencia
     *
     * @ORM\ManyToOne(targetEntity="TipoCompetencia", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_competencia_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoCompetenciaId;

    /**
     * @var Deporte
     *
     * @ORM\ManyToOne(targetEntity="Deporte", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deporte_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $deporteId;

    /**
     * @var TipoPuntuacion
     * @ORM\ManyToOne(targetEntity="TipoPuntuacion", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_puntuacion_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoPuntuacionId;

    /**
     * @var Fixture
     *
     * @ORM\OneToOne(targetEntity="Fixture", inversedBy="competencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fixture_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $fixtureId;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy= "listaCompetencias", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $usuarioId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SedesCompetencia", mappedBy="competenciaId", cascade={"persist", "remove"})
     */
    private $listaSedesCompetencia;


    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Participante", mappedBy="competenciaId", cascade={"persist", "remove"})
     *
     */
    private $listaParticipantes;







    /**
     * @return EstadoCompetencia
     */
    public function getEstadoCompetenciaId(): EstadoCompetencia
    {
        return $this->estadoCompetenciaId;
    }

    /**
     * @param EstadoCompetencia $estadoCompetenciaId
     */
    public function setEstadoCompetenciaId(EstadoCompetencia $estadoCompetenciaId): void
    {
        $this->estadoCompetenciaId = $estadoCompetenciaId;
    }



}

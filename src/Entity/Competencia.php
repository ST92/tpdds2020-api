<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
    private $id=0;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

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
     * @ORM\Column(name="ptos_ganado", type="integer", nullable=true)
     */
    private $ptosGanado;

    /**
     * @var int
     *
     * @ORM\Column(name="ptos_empate", type="integer", nullable=true)
     */
    private $ptosEmpate;

    /**
     * @var int
     *
     * @ORM\Column(name="ptos_presentacion", type="integer", nullable=true)
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
     *
     * @Exclude()
     *
     */
    private $fechaBaja;


    /**
     * @var EstadoCompetencia
     *
     * @ORM\ManyToOne(targetEntity="EstadoCompetencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_competencia_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $estadoCompetenciaId;

    /**
     * @var TipoCompetencia
     *
     * @ORM\ManyToOne(targetEntity="TipoCompetencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_competencia_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoCompetenciaId;

    /**
     * @var Deporte
     *
     * @ORM\ManyToOne(targetEntity="Deporte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deporte_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $deporteId;

    /**
     * @var TipoPuntuacion
     * @ORM\ManyToOne(targetEntity="TipoPuntuacion")
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
     *
     * @Exclude()
     *
     */
    private $fixtureId;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
     */
    private $usuarioId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SedesCompetencia", mappedBy="competenciaId", cascade={"persist", "remove"})
     * @Exclude()
     */
    private $listaSedesCompetencia;


    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Participante", mappedBy="competenciaId", cascade={"persist", "remove"})
     *
     * @Exclude()
     *
     */
    private $listaParticipantes;






    /**
     * @return EstadoCompetencia
     */
    public function getEstadoCompetenciaId()
    {
        return $this->estadoCompetenciaId;
    }

    /**
     * @param EstadoCompetencia $estadoCompetenciaId
     */
    public function setEstadoCompetenciaId(EstadoCompetencia $estadoCompetenciaId)
    {
        $this->estadoCompetenciaId = $estadoCompetenciaId;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getReglamento()
    {
        return $this->reglamento;
    }

    /**
     * @param string $reglamento
     */
    public function setReglamento(string $reglamento)
    {
        $this->reglamento = $reglamento;
    }

    /**
     * @return bool
     */
    public function isPermiteEmpate()
    {
        return $this->permiteEmpate;
    }

    /**
     * @param bool $permiteEmpate
     */
    public function setPermiteEmpate(bool $permiteEmpate)
    {
        $this->permiteEmpate = $permiteEmpate;
    }

    /**
     * @return int
     */
    public function getPtosGanado()
    {
        return $this->ptosGanado;
    }

    /**
     * @param int $ptosGanado
     */
    public function setPtosGanado(int $ptosGanado)
    {
        $this->ptosGanado = $ptosGanado;
    }

    /**
     * @return int
     */
    public function getPtosEmpate()
    {
        return $this->ptosEmpate;
    }

    /**
     * @param $ptosEmpate
     */
    public function setPtosEmpate($ptosEmpate)
    {
        $this->ptosEmpate = $ptosEmpate;
    }

    /**
     * @return int
     */
    public function getPtosPresentacion()
    {
        return $this->ptosPresentacion;
    }

    /**
     * @param int $ptosPresentacion
     */
    public function setPtosPresentacion(int $ptosPresentacion)
    {
        $this->ptosPresentacion = $ptosPresentacion;
    }

    /**
     * @return int
     */
    public function getPtosAusencia()
    {
        return $this->ptosAusencia;
    }

    /**
     * @param int $ptosAusencia
     */
    public function setPtosAusencia(int $ptosAusencia)
    {
        $this->ptosAusencia = $ptosAusencia;
    }

    /**
     * @return int
     */
    public function getCantidadSets()
    {
        return $this->cantidadSets;
    }

    /**
     * @param int $cantidadSets
     */
    public function setCantidadSets(int $cantidadSets)
    {
        $this->cantidadSets = $cantidadSets;
    }

    /**
     * @return DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * @param DateTime $fechaBaja
     */
    public function setFechaBaja(DateTime $fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    /**
     * @return TipoCompetencia
     */
    public function getTipoCompetenciaId()
    {
        return $this->tipoCompetenciaId;
    }

    /**
     * @param TipoCompetencia $tipoCompetenciaId
     */
    public function setTipoCompetenciaId(TipoCompetencia $tipoCompetenciaId)
    {
        $this->tipoCompetenciaId = $tipoCompetenciaId;
    }

    /**
     * @return Deporte
     */
    public function getDeporteId()
    {
        return $this->deporteId;
    }

    /**
     * @param Deporte $deporteId
     */
    public function setDeporteId(Deporte $deporteId)
    {
        $this->deporteId = $deporteId;
    }

    /**
     * @return TipoPuntuacion
     */
    public function getTipoPuntuacionId()
    {
        return $this->tipoPuntuacionId;
    }

    /**
     * @param TipoPuntuacion $tipoPuntuacionId
     */
    public function setTipoPuntuacionId(TipoPuntuacion $tipoPuntuacionId)
    {
        $this->tipoPuntuacionId = $tipoPuntuacionId;
    }

    /**
     * @return Fixture
     */
    public function getFixtureId()
    {
        return $this->fixtureId;
    }

    /**
     * @param $fixtureId
     */
    public function setFixtureId($fixtureId)
    {
        $this->fixtureId = $fixtureId;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param Usuario $usuarioId
     */
    public function setUsuarioId(Usuario $usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaSedesCompetencia()
    {
        return $this->listaSedesCompetencia;
    }

    /**
     * @param ArrayCollection $listaSedesCompetencia
     */
    public function setListaSedesCompetencia($listaSedesCompetencia)
    {
        $this->listaSedesCompetencia = $listaSedesCompetencia;
    }


    /**
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaParticipantes()
    {
        return $this->listaParticipantes;
    }

    /**
     * @param ArrayCollection $listaParticipantes
     */
    public function setListaParticipantes(ArrayCollection $listaParticipantes)
    {
        $this->listaParticipantes = $listaParticipantes;
    }




}

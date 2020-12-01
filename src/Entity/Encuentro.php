<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Exclude;

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
    private $encuentroEmpatado=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="asistencia_participante_1", type="boolean", nullable=false)
     */
    private $asistenciaParticipante1=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="asistencia_participante_2", type="boolean", nullable=false)
     */
    private $asistenciaParticipante2=false;


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
     * @ORM\ManyToOne(targetEntity="Ronda", inversedBy= "listaEncuentros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ronda_id", referencedColumnName="id", nullable=false)
     * })
     *
     * Porque encuentro iría dentro de la lista de rondas
     * @Exclude()
     *
     */
    private $rondaId;

    /**
     * @var Encuentro
     *
     * @ORM\OneToOne(targetEntity="Encuentro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_perdedor_id", referencedColumnName="id", nullable=true)
     * })
     *
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




    /**
     * Encuentro constructor.
     */
    public function __construct()
    {
        $this->listaResultados = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isEncuentroEmpatado()
    {
        return $this->encuentroEmpatado;
    }

    /**
     * @param bool $encuentroEmpatado
     */
    public function setEncuentroEmpatado(bool $encuentroEmpatado)
    {
        $this->encuentroEmpatado = $encuentroEmpatado;
    }

    /**
     * @return bool
     */
    public function isAsistenciaParticipante1()
    {
        return $this->asistenciaParticipante1;
    }

    /**
     * @param bool $asistenciaParticipante1
     */
    public function setAsistenciaParticipante1(bool $asistenciaParticipante1)
    {
        $this->asistenciaParticipante1 = $asistenciaParticipante1;
    }

    /**
     * @return bool
     */
    public function isAsistenciaParticipante2()
    {
        return $this->asistenciaParticipante2;
    }

    /**
     * @param bool $asistenciaParticipante2
     */
    public function setAsistenciaParticipante2(bool $asistenciaParticipante2)
    {
        $this->asistenciaParticipante2 = $asistenciaParticipante2;
    }

    /**
     * @return Participante
     */
    public function getParticipante1Id()
    {
        return $this->participante1Id;
    }

    /**
     * @param Participante $participante1Id
     */
    public function setParticipante1Id(Participante $participante1Id)
    {
        $this->participante1Id = $participante1Id;
    }

    /**
     * @return Participante
     */
    public function getParticipante2Id()
    {
        return $this->participante2Id;
    }

    /**
     * @param Participante $participante2Id
     */
    public function setParticipante2Id(Participante $participante2Id)
    {
        $this->participante2Id = $participante2Id;
    }

    /**
     * @return Participante
     */
    public function getGanadorId()
    {
        return $this->ganadorId;
    }

    /**
     * @param Participante $ganadorId
     */
    public function setGanadorId(Participante $ganadorId)
    {
        $this->ganadorId = $ganadorId;
    }

    /**
     * @return Sedes
     */
    public function getSedesId()
    {
        return $this->sedesId;
    }

    /**
     * @param Sedes $sedesId
     */
    public function setSedesId(Sedes $sedesId)
    {
        $this->sedesId = $sedesId;
    }

    /**
     * @return Ronda
     */
    public function getRondaId()
    {
        return $this->rondaId;
    }

    /**
     * @param Ronda $rondaId
     */
    public function setRondaId(Ronda $rondaId)
    {
        $this->rondaId = $rondaId;
    }

    /**
     * @return Encuentro
     */
    public function getEncuentroPerdedorId()
    {
        return $this->encuentroPerdedorId;
    }

    /**
     * @param Encuentro $encuentroPerdedorId
     */
    public function setEncuentroPerdedorId(Encuentro $encuentroPerdedorId)
    {
        $this->encuentroPerdedorId = $encuentroPerdedorId;
    }

    /**
     * @return Encuentro
     */
    public function getEncuentroGanadorId()
    {
        return $this->encuentroGanadorId;
    }

    /**
     * @param Encuentro $encuentroGanadorId
     */
    public function setEncuentroGanadorId(Encuentro $encuentroGanadorId)
    {
        $this->encuentroGanadorId = $encuentroGanadorId;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaResultados()
    {
        return $this->listaResultados;
    }

    /**
     * @param ArrayCollection $listaResultados
     */
    public function setListaResultados(ArrayCollection $listaResultados)
    {
        $this->listaResultados = $listaResultados;
    }


}

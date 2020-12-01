<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Exclude;


/**
 * HistorialEncuentro
 *
 * @ORM\Table(name="historialencuentro")
 * @ORM\Entity
 */
class HistorialEncuentro
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
     * @var DateTime
     *
     * @ORM\Column(name="fecha_historial", type="date", nullable=false)
     */
    private $fechaHistorial;


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
     *   @ORM\JoinColumn(name="ganador_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $ganadorId;


    /**
     * @var Encuentro
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_id", referencedColumnName="id", nullable=false)
     * })
     *
     *
     */
    private $encuentroId;


    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HistorialResultado", mappedBy="historialEncuentroId", cascade={"persist", "remove"})
     */
    private $listaResultados;



}

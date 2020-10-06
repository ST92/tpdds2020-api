<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistorialResultado
 *
 * @ORM\Table(name="historialresultado")
 * @ORM\Entity
 */
class HistorialResultado
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_historial", type="date", nullable=false)
     */
    private $fechaHistorial;

    /**
     * @var int
     *
     * @ORM\Column(name="puntos_participante_1", type="integer", nullable=false)
     */
    private $puntosParticipante1;

    /**
     * @var int
     *
     * @ORM\Column(name="puntos_participante_2", type="integer", nullable=false)
     */
    private $puntosParticipante2;

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
     * @var int
     *
     * @ORM\Column(name="ganador_id", type="integer", nullable=false)
     */
    private $ganadorId;

    /**
     * @var int
     *
     * @ORM\Column(name="encuentro_id", type="integer", nullable=false)
     */
    private $encuentroId;


}

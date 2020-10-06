<?php

namespace App\Entity;

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
     * @var int
     *
     * @ORM\Column(name="participante1_id", type="integer", nullable=false)
     */
    private $participante1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="participante2_id", type="integer", nullable=false)
     */
    private $participante2Id;

    /**
     * @var int
     *
     * @ORM\Column(name="ganador_id", type="integer", nullable=false)
     */
    private $ganadorId;

    /**
     * @var int
     *
     * @ORM\Column(name="sedes_id", type="integer", nullable=false)
     */
    private $sedesId;

    /**
     * @var int
     *
     * @ORM\Column(name="ronda_id", type="integer", nullable=false)
     */
    private $rondaId;

    /**
     * @var int
     *
     * @ORM\Column(name="encuentro_perdedor_id", type="integer", nullable=false)
     */
    private $encuentroPerdedorId;

    /**
     * @var int
     *
     * @ORM\Column(name="encuentro_ganador_id", type="integer", nullable=false)
     */
    private $encuentroGanadorId;


}

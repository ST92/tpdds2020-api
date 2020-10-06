<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultado
 *
 * @ORM\Table(name="resultado")
 * @ORM\Entity
 */
class Resultado
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
     * @var int
     *
     * @ORM\Column(name="encuentro_id", type="integer", nullable=false)
     */
    private $encuentroId;

    /**
     * @var int
     *
     * @ORM\Column(name="historial_resultado_id", type="integer", nullable=false)
     */
    private $historialResultadoId;


}

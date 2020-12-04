<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

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
     * @var Encuentro
     * @ORM\ManyToOne(targetEntity="Encuentro", inversedBy= "listaResultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_id", referencedColumnName="id", nullable=false)
     * })
     *
     * @Exclude()
     */
    private $encuentroId;



}

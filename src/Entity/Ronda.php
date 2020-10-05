<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ronda
 *
 * @ORM\Table(name="ronda", indexes={@ORM\Index(name="fixture_fk_2", columns={"fixture_perdedores_id"}), @ORM\Index(name="fixture_fk_1", columns={"fixture_id"})})
 * @ORM\Entity
 */
class Ronda
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
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="fixture_id", type="integer", nullable=false)
     */
    private $fixtureId;

    /**
     * @var int
     *
     * @ORM\Column(name="fixture_perdedores_id", type="integer", nullable=false)
     */
    private $fixturePerdedoresId;


}

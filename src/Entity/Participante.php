<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Finder\Tests\Comparator\ComparatorTest;

/**
 * Participante
 *
 * @ORM\Table(name="participante", indexes={@ORM\Index(name="competencia_fk_1", columns={"competencia_id"})})
 * @ORM\Entity
 */
class Participante
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

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var Competencia
     *
     * @ORM\ManyToOne(targetEntity="Competencia", inversedBy= "listaParticipantes", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competencia_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $competenciaId;


}

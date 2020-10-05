<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sedesdeporte
 *
 * @ORM\Table(name="sedesdeporte", indexes={@ORM\Index(name="sedes_fk_3", columns={"sedes_id"}), @ORM\Index(name="deporte_fk_2", columns={"deporte_id"})})
 * @ORM\Entity
 */
class Sedesdeporte
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
     * @ORM\Column(name="deporte_id", type="integer", nullable=false)
     */
    private $deporteId;

    /**
     * @var int
     *
     * @ORM\Column(name="sedes_id", type="integer", nullable=false)
     */
    private $sedesId;


}

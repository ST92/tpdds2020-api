<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deporte
 *
 * @ORM\Table(name="deporte")
 * @ORM\Entity
 */
class Deporte
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


}

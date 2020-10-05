<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoCompetencia
 *
 * @ORM\Table(name="tipocompetencia")
 * @ORM\Entity
 */
class TipoCompetencia
{
    const LIGA = 1;
    const ELIMINACION_SIMPLE = 2;
    const ELIMINACION_DOBLE = 3;


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

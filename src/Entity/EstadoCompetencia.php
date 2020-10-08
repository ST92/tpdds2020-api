<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoCompetencia
 *
 * @ORM\Table(name="estadocompetencia")
 * @ORM\Entity
 */
class EstadoCompetencia
{
    const CREADA = 1;
    const PLANIFICADA = 2;
    const EN_DISPUTA = 3;
    const FINALIZADA = 4;
    const ELIMINADA = 5;


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
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     */
    public function getNombre()
    {
        return $this->nombre;
    }



}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoPuntuacion
 *
 * @ORM\Table(name="tipopuntuacion")
 * @ORM\Entity
 */
class TipoPuntuacion
{
    const SETS = 1;
    const PUNTUACION = 2;
    const RESULTADO_FINAL = 3;


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
     * @param $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param  $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }



}

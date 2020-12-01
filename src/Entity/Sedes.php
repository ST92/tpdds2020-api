<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * Sedes
 *
 * @ORM\Table(name="sedes", indexes={@ORM\Index(name="usuario_fk_2", columns={"usuario_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SedesRepository")
 */
class Sedes
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
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha_borrado",type="date", nullable=true)
     * @Exclude()
     */
    private $fechaBorrado;

    /**
     * @var Usuario
     *
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     * @Exclude()
     */
    private $usuarioId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Deporte", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="sedesdeporte",
     *     joinColumns={@ORM\JoinColumn(name="sedes_id", referencedColumnName = "id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="deporte_id", referencedColumnName = "id")})
     * @Exclude()
     */
    private $listaDeportes;








    /**
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     */
    public function getFechaBorrado()
    {
        return $this->fechaBorrado;
    }

    /**
     * @param $fechaBorrado
     */
    public function setFechaBorrado($fechaBorrado)
    {
        $this->fechaBorrado = $fechaBorrado;
    }

    /**
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param  $usuarioId
     */
    public function setUsuarioId( $usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaDeportes()
    {
        return $this->listaDeportes;
    }

    /**
     * @param ArrayCollection $listaDeportes
     */
    public function setListaDeportes(ArrayCollection $listaDeportes)
    {
        $this->listaDeportes = $listaDeportes;
    }



}

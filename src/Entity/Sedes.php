<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sedes
 *
 * @ORM\Table(name="sedes", indexes={@ORM\Index(name="usuario_fk_2", columns={"usuario_id"})})
 * @ORM\Entity
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
     * @ORM\Column(name="fecha_borrado", type="date", nullable=false)
     */
    private $fechaBorrado;

    /**
     * @var int
     *
     * @ORM\Column(name="usuario_id", type="integer", nullable=false)
     */
    private $usuarioId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Deporte", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="sedesdeporte",
     *     joinColumns={@ORM\JoinColumn(name="sedes_id", referencedColumnName = "id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="deporte_id", referencedColumnName = "id")})
     * @Expose
     */
    private $listaDeportes;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SedesCompetencia", mappedBy="sedesId", cascade={"persist", "remove"})
     *
     */
    private $listaSedesCompetencia; //TODO Quitar si no corresponde


}

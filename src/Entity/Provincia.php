<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * Provincia
 *
 * @ORM\Table(name="provincia", indexes={@ORM\Index(name="pais_fk_1", columns={"pais_id"})})
 * @ORM\Entity
 */
class Provincia
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
     * @var Pais
     *
     *
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy= "listaProvincias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
     */
    private $paisId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Localidad", mappedBy="provinciaId", cascade={"persist", "remove"})
     *
     */
    private $listaLocalidades;

}

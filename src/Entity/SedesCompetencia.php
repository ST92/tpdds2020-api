<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SedesCompetencia
 *
 * @ORM\Table(name="sedescompetencia", indexes={@ORM\Index(name="sedes_fk_2", columns={"sedes_id"}), @ORM\Index(name="competencia_fk_2", columns={"competencia_id"})})
 * @ORM\Entity
 */
class SedesCompetencia
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
     * @ORM\Column(name="disponibilidad", type="integer", nullable=false)
     */
    private $disponibilidad;

    /**
     * @var Competencia
     *
     * @ORM\ManyToOne(targetEntity="Competencia", inversedBy= "listaSedesCompetencia", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competencia_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $competenciaId;

    /**
     * @var Sedes
     *
     * @ORM\ManyToOne(targetEntity="Sedes", inversedBy= "listaSedesCompetencia", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sedes_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $sedesId;

    //TODO Consultar: es una relación bidireccional con sedes?


}

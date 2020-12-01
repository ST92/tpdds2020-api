<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

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
     * @ORM\ManyToOne(targetEntity="Competencia", inversedBy= "listaSedesCompetencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competencia_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
     *
     */
    private $competenciaId;

    /**
     * @var Sedes
     *
     * @ORM\ManyToOne(targetEntity="Sedes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sedes_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $sedesId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return int
     */
    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    /**
     * @param int $disponibilidad
     */
    public function setDisponibilidad(int $disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;
    }

    /**
     * @return Competencia
     */
    public function getCompetenciaId()
    {
        return $this->competenciaId;
    }

    /**
     * @param Competencia $competenciaId
     */
    public function setCompetenciaId(Competencia $competenciaId)
    {
        $this->competenciaId = $competenciaId;
    }

    /**
     * @return Sedes
     */
    public function getSedesId()
    {
        return $this->sedesId;
    }

    /**
     * @param Sedes $sedesId
     */
    public function setSedesId(Sedes $sedesId)
    {
        $this->sedesId = $sedesId;
    }





}

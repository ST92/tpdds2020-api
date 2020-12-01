<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Finder\Tests\Comparator\ComparatorTest;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Exclude;

/**
 * Participante
 *
 * @ORM\Table(name="participante", indexes={@ORM\Index(name="competencia_fk_1", columns={"competencia_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ParticipanteRepository")
 *
 * @UniqueEntity(
 *     fields={"nombre"},
 *     message="El nombre de participante ingresado ya existe."
 * )
 * @UniqueEntity(fields="email", message="El email ingresado ya está asociado a otro participante.")
 */
class Participante
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var Competencia
     *
     *
     * @ORM\ManyToOne(targetEntity="Competencia", inversedBy= "listaParticipantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competencia_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
     */
    private $competenciaId;

    /**
     * @return int
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
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return
     */
    public function getCompetenciaId()
    {
        return $this->competenciaId;
    }

    /**
     * @param $competenciaId
     */
    public function setCompetenciaId($competenciaId)
    {
        $this->competenciaId = $competenciaId;
    }



}

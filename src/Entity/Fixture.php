<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * Fixture
 *
 * @ORM\Table(name="fixture")
 * @ORM\Entity(repositoryClass="App\Repository\FixtureRepository")
 */
class Fixture
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
     * @var Competencia
     *
     * @ORM\OneToOne(targetEntity="Competencia", mappedBy="fixtureId")
     * @Exclude()
     */
    private $competencia;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Ronda", mappedBy="fixtureId", cascade={"persist", "remove"})
     */
    private $listaRondas;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Ronda", mappedBy="fixturePerdedoresId", cascade={"persist", "remove"})
     *
     */
    private $listaRondasPerdedores;






    /**
     * Fixture constructor.
     *
     */
    public function __construct()
    {
        $this->listaRondas = new ArrayCollection();
    }

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
     * @return Competencia
     */
    public function getCompetencia()
    {
        return $this->competencia;
    }

    /**
     * @param Competencia $competencia
     */
    public function setCompetencia(Competencia $competencia)
    {
        $this->competencia = $competencia;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaRondas()
    {
        return $this->listaRondas;
    }

    /**
     * @param ArrayCollection $listaRondas
     */
    public function setListaRondas(ArrayCollection $listaRondas)
    {
        $this->listaRondas = $listaRondas;
    }




}

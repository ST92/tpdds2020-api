<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     *
     */
    private $competencia;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Ronda", mappedBy="fixtureId", cascade={"persist", "remove"})
     */
    private $listaRondas;

    //TODO Falta la asociación con lista de ronda para perdedores

    /**
     * Fixture constructor.
     * @param ArrayCollection $listaRondas
     */
    public function __construct()
    {
        $this->listaRondas = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Competencia
     */
    public function getCompetencia(): Competencia
    {
        return $this->competencia;
    }

    /**
     * @param Competencia $competencia
     */
    public function setCompetencia(Competencia $competencia): void
    {
        $this->competencia = $competencia;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaRondas(): ArrayCollection
    {
        return $this->listaRondas;
    }

    /**
     * @param ArrayCollection $listaRondas
     */
    public function setListaRondas(ArrayCollection $listaRondas): void
    {
        $this->listaRondas = $listaRondas;
    }



}

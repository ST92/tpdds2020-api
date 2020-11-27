<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ronda
 *
 * @ORM\Table(name="ronda", indexes={@ORM\Index(name="fixture_fk_2", columns={"fixture_perdedores_id"}), @ORM\Index(name="fixture_fk_1", columns={"fixture_id"})})
 * @ORM\Entity
 */
class Ronda
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
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="fixture_id", type="integer", nullable=false)
     */
    private $fixtureId;

    /**
     * @var int
     *
     * @ORM\Column(name="fixture_perdedores_id", type="integer", nullable=false)
     */
    private $fixturePerdedoresId;

    /**
     *  @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Encuentro", mappedBy="rondaId", cascade={"persist", "remove"})
     */
    private $listaEncuentros;

    /**
     * Ronda constructor.
     * @param ArrayCollection $listaEncuentros
     */
    public function __construct()
    {
        $this->listaEncuentros = new ArrayCollection();
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
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return int
     */
    public function getFixtureId(): int
    {
        return $this->fixtureId;
    }

    /**
     * @param int $fixtureId
     */
    public function setFixtureId(int $fixtureId): void
    {
        $this->fixtureId = $fixtureId;
    }

    /**
     * @return int
     */
    public function getFixturePerdedoresId(): int
    {
        return $this->fixturePerdedoresId;
    }

    /**
     * @param int $fixturePerdedoresId
     */
    public function setFixturePerdedoresId(int $fixturePerdedoresId): void
    {
        $this->fixturePerdedoresId = $fixturePerdedoresId;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaEncuentros(): ArrayCollection
    {
        return $this->listaEncuentros;
    }

    /**
     * @param ArrayCollection $listaEncuentros
     */
    public function setListaEncuentros(ArrayCollection $listaEncuentros): void
    {
        $this->listaEncuentros = $listaEncuentros;
    }



}

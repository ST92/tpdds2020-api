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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var Fixture
     *
     * @ORM\ManyToOne(targetEntity="Fixture", inversedBy= "listaRondas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fixture_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $fixtureId;

    /**
     * @var Fixture
     *
     * @ORM\ManyToOne(targetEntity="Fixture", inversedBy= "listaRondasPerdedores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fixture_perdedores_id", referencedColumnName="id", nullable=true)
     * })
     *
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
     * @return Fixture
     */
    public function getFixtureId()
    {
        return $this->fixtureId;
    }

    /**
     * @param Fixture $fixtureId
     */
    public function setFixtureId($fixtureId)
    {
        $this->fixtureId = $fixtureId;
    }

    /**
     * @return Fixture
     */
    public function getFixturePerdedoresId()
    {
        return $this->fixturePerdedoresId;
    }

    /**
     * @param $fixturePerdedoresId
     */
    public function setFixturePerdedoresId($fixturePerdedoresId): void
    {
        $this->fixturePerdedoresId = $fixturePerdedoresId;
    }

    /**
     * @return ArrayCollection
     */
    public function getListaEncuentros()
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

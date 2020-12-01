<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

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
     * @var Fixture
     *
     * @ORM\ManyToOne(targetEntity="Fixture", inversedBy= "listaRondas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fixture_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
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
     * @Exclude()
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
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
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
    public function setFixturePerdedoresId($fixturePerdedoresId)
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
    public function setListaEncuentros(ArrayCollection $listaEncuentros)
    {
        $this->listaEncuentros = $listaEncuentros;
    }



}

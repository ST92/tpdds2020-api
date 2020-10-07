<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fixture
 *
 * @ORM\Table(name="fixture")
 * @ORM\Entity
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



}

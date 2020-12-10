<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * Resultado
 *
 * @ORM\Table(name="historialresultado")
 * @ORM\Entity
 */
class HistorialResultado{

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
     * @ORM\Column(name="puntosparticipante1", type="integer", nullable=false)
     */
    private $puntosParticipante1;

    /**
     * @var int
     *
     * @ORM\Column(name="puntosparticipante2", type="integer", nullable=false)
     */
    private $puntosParticipante2;

    /**
     * @var HistorialEncuentro
     *
     * @ORM\ManyToOne(targetEntity="HistorialEncuentro", inversedBy= "listaResultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="historial_encuentro_id", referencedColumnName="id", nullable=false)
     * })
     * @Exclude()
     */
    private $historialEncuentroId;

}
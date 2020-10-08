<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="tipo_documento_fk_1", columns={"tipo_documento_id"}), @ORM\Index(name="localidad_fk_2", columns={"localidad_id"})})
 * @ORM\Entity
 */
class Usuario
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="documento", type="integer", nullable=false)
     */
    private $documento;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmacion_terminos", type="boolean", nullable=false)
     */
    private $confirmacionTerminos;

    /**
     * @var int
     *
     * @ORM\Column(name="localidad_id", type="integer", nullable=false)
     */
    private $localidadId;

    /**
     * @var int
     *
     * @ORM\Column(name="tipo_documento_id", type="integer", nullable=false)
     */
    private $tipoDocumentoId;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Competencia", mappedBy="usuarioId", cascade={"persist", "remove"})
     *
     */
    private $listaCompetencias;

    /**
     *  @var ArrayCollection
     *
     */
    private $listaSedes;



    /**
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  $id
     */
    public function setId( $id)
    {
        $this->id = $id;
    }

    /**
     *
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param  $nombre
     */
    public function setNombre( $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     *
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param  $apellido
     */
    public function setApellido( $apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     *
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param  $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword( $password)
    {
        $this->password = $password;
    }

    /**
     *
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     */
    public function isConfirmacionTerminos()
    {
        return $this->confirmacionTerminos;
    }

    /**
     * @param  $confirmacionTerminos
     */
    public function setConfirmacionTerminos($confirmacionTerminos)
    {
        $this->confirmacionTerminos = $confirmacionTerminos;
    }

    /**
     *
     */
    public function getLocalidadId()
    {
        return $this->localidadId;
    }

    /**
     * @param $localidadId
     */
    public function setLocalidadId($localidadId)
    {
        $this->localidadId = $localidadId;
    }

    /**
     *
     */
    public function getTipoDocumentoId()
    {
        return $this->tipoDocumentoId;
    }

    /**
     * @param $tipoDocumentoId
     */
    public function setTipoDocumentoId($tipoDocumentoId)
    {
        $this->tipoDocumentoId = $tipoDocumentoId;
    }

    /**
     *
     */
    public function getListaCompetencias()
    {
        return $this->listaCompetencias;
    }

    /**
     * @param $listaCompetencias
     */
    public function setListaCompetencias($listaCompetencias)
    {
        $this->listaCompetencias = $listaCompetencias;
    }

    /**
     *
     */
    public function getListaSedes()
    {
        return $this->listaSedes;
    }

    /**
     * @param $listaSedes
     */
    public function setListaSedes($listaSedes)
    {
        $this->listaSedes = $listaSedes;
    }



}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="tipo_documento_fk_1", columns={"tipo_documento_id"}), @ORM\Index(name="localidad_fk_2", columns={"localidad_id"})})
 * @ORM\Entity
 */
class Usuario implements JWTUserInterface
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
     *  @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="usuarioId", cascade={"persist", "remove"})
     *
     */
    private $listaCompetencias;


    /**
     * Creates a new instance from a given JWT payload.
     *
     * @param string $username
     * @param array $payload
     *
     * @return JWTUserInterface
     */
    public static function createFromPayload($username, array $payload)
    {

    }


    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

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
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="IXFK_usuario_foto", columns={"foto_id"}), @ORM\Index(name="IXFK_usuario_rol", columns={"rol_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 *
 * @UniqueEntity("email")
 */
class Usuario implements JWTUserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Groups({"admin","cadete","usuario"})
     */
    private $id;

    /**
     * @var Rol
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rol_id", referencedColumnName="id", nullable=false)
     * })
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="App\Entity\Rol")
     *
     * @JMS\Groups({"admin","cadete","usuario"})
     */
    private $rol;

    /**
     * @var Foto
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Foto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="foto_id", referencedColumnName="id", nullable=true)
     * })
     *
     * @Assert\Type(type="App\Entity\Foto")
     *
     * @JMS\Groups({"admin","usuario"})
     */
    private $foto;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CtaCteItem", mappedBy="usuario")
     */
    private $ctaCteItems;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=false)
     *
     * @Assert\NotBlank()
     *
     * @JMS\Groups({"admin","usuario"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false, unique=true)
     *
     * @Assert\NotBlank()
     *
     * @JMS\Groups({"admin","usuario"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank()
     *
     * @JMS\Groups({"admin","usuario"})
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cta_cte", type="boolean", nullable=false, options={"default"="0"})
     *
     * @JMS\Groups({"admin"})
     */
    private $ctaCte = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false, options={"default"="1"})
     *
     * @JMS\Groups({"admin"})
     */
    private $activo = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_validado", type="boolean", nullable=false, options={"default"="0"})
     *
     * @JMS\Groups({"admin"})
     */
    private $emailValidado = false;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="fecha_alta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime|null
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="fecha_modificado", type="datetime", nullable=true)
     */
    private $fechaModificado;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_ultimo_acceso", type="datetime", nullable=true)
     *
     * @JMS\Groups({"admin"})
     * @JMS\Type("DateTime<'d/m/Y H:i:s'>")
     */
    private $fechaUltimoAcceso;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_borrado", type="datetime", nullable=true)
     *
     * @JMS\Exclude
     */
    private $fechaBorrado;

    public function __construct($username = '', array $roles = [], $email = '')
    {
        $this->email = $username;
        if (isset($roles[0])) {
            $this->rol = new Rol('', $roles[0]);
        }
        $this->email = $email;
        $this->salt = md5(uniqid(null, true));
        $this->ctaCteItems = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param Rol $rol
     *
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @return Foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param Foto $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return array($this->getRol()->getConstante());
    }

    public function setRoles(array $rol): self
    {
        $this->rol = $rol[0];

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return bool
     */
    public function isCtaCte()
    {
        return $this->ctaCte;
    }

    /**
     * @param bool $ctaCte
     */
    public function setCtaCte($ctaCte)
    {
        $this->ctaCte = $ctaCte;
    }

    /**
     * @return bool
     */
    public function isActivo()
    {
        return $this->activo;
    }

    /**
     * @param bool $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return bool
     */
    public function isEmailValidado()
    {
        return $this->emailValidado;
    }

    /**
     * @param bool $emailValidado
     */
    public function setEmailValidado($emailValidado)
    {
        $this->emailValidado = $emailValidado;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Get fechaModificado
     *
     * @return \DateTime
     */
    public function getFechaModificado()
    {
        return $this->fechaModificado;
    }

    /**
     * @return \DateTime
     */
    public function getFechaUltimoAcceso()
    {
        return $this->fechaUltimoAcceso;
    }

    /**
     * @param \DateTime $fechaUltimoAcceso
     */
    public function setFechaUltimoAcceso($fechaUltimoAcceso)
    {
        $this->fechaUltimoAcceso = $fechaUltimoAcceso;
    }

    /**
     * Set fechaBorrado
     *
     * @param $fechaBorrado
     *
     * @return Usuario
     */
    public function setFechaBorrado($fechaBorrado)
    {
        $this->fechaBorrado = $fechaBorrado;

        return $this;
    }

    /**
     * Get fechaBorrado
     *
     * @return \DateTime
     */
    public function getFechaBorrado()
    {
        return $this->fechaBorrado;
    }

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
        return new self(
            $username,
            $payload['roles'], // Added by default
            $payload['email']
        );
    }
}

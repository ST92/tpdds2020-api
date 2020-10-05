<?php

namespace App\DataFixtures;
/*
use App\Entity\Estado;
use App\Entity\MedioPago;
use App\Entity\Rol;
use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
*/
class AppFixtures //extends Fixture
{
    /*private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Cargo los roles
        $rol1 = new Rol();
        $rol1->setNombre('Admin');
        $rol1->setConstante('ROLE_ADMIN');
        $manager->persist($rol1);

        $rol2 = new Rol();
        $rol2->setNombre('Cadete');
        $rol2->setConstante('ROLE_CADETE');
        $manager->persist($rol2);

        $rol3 = new Rol();
        $rol3->setNombre('Usuario');
        $rol3->setConstante('ROLE_USUARIO');
        $manager->persist($rol3);

        // Cargo los usuarios
        $admin1 = new Usuario();
        $admin1->setNombre('Admin');
        $admin1->setRol($rol1);
        $admin1->setEmail('admin@admin.com');
        $password = $this->encoder->encodePassword($admin1, '456123');
        $admin1->setPassword($password);
        $admin1->setCelular('456123');
        $manager->persist($admin1);

        $cadete1 = new Usuario();
        $cadete1->setNombre('Cadete');
        $cadete1->setRol($rol2);
        $cadete1->setEmail('cadete@cadete.com');
        $password = $this->encoder->encodePassword($cadete1, '456123');
        $cadete1->setPassword($password);
        $cadete1->setCelular('456123');
        $manager->persist($cadete1);

        $usuario1 = new Usuario();
        $usuario1->setNombre('Usuario');
        $usuario1->setRol($rol3);
        $usuario1->setEmail('usuario@usuario.com');
        $password = $this->encoder->encodePassword($usuario1, '456123');
        $usuario1->setPassword($password);
        $usuario1->setCelular('456123');
        $manager->persist($usuario1);

        // Cargo los medios de pago
        $medioPago1 = new MedioPago();
        $medioPago1->setNombre('Efectivo');
        $manager->persist($medioPago1);

        $medioPago2 = new MedioPago();
        $medioPago2->setNombre('Cuenta Corriente');
        $manager->persist($medioPago2);

        $medioPago3 = new MedioPago();
        $medioPago3->setNombre('Mercado Pago');
        $manager->persist($medioPago3);

        // Cargo los estados
        $estado1 = new Estado();
        $estado1->setNombre('Pendiente');
        $manager->persist($estado1);

        $estado2 = new Estado();
        $estado2->setNombre('Cadete asignado');
        $manager->persist($estado2);

        $estado3 = new Estado();
        $estado3->setNombre('En tránsito');
        $manager->persist($estado3);

        $estado4 = new Estado();
        $estado4->setNombre('Entregado');
        $manager->persist($estado4);

        $estado5 = new Estado();
        $estado5->setNombre('Devuelto');
        $manager->persist($estado5);

        $estado6 = new Estado();
        $estado6->setNombre('Cancelado');
        $manager->persist($estado6);

        $manager->flush();
    }*/
}

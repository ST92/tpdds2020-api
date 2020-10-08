<?php

namespace App\EventListener;

use App\Entity\Rol;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ExtendedViewResponseListener
{
    /**
     * @var TokenStorage
     *
     */
    private $tokenStorage;

    public function __construct($tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $viewAttribute = $event->getRequest()->attributes->get('_template');
        if (null !== $viewAttribute) {
            $groups = [];
            $usuario = $this->tokenStorage->getToken()->getUser();
            if ($usuario == 'anon.'
                && in_array($event->getRequest()->getPathInfo(), [
                    '/api/usuarios/registro',
                    '/api/usuarios/recuperarclave',
                    '/api/usuarios/esemailunico',
                    '/api/usuarios/nuevaclave',
                    '/api/contactos',
                    '/api/competencias'

                ])
                && ($event->getRequest()->getMethod() == 'POST' || $event->getRequest()->getMethod() == 'GET')) {
                $groups[] = 'ROLE_USUARIO';
            } else {
                $groups[] = strtolower(str_replace('ROLE_', '', $usuario->getRol()->getConstante()));
            }
            $viewAttribute->setSerializerGroups($groups);
        }
    }
}
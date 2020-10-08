<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;


class AuthenticationSuccessListener
{
    /**
     * @var Request
     */
    protected $request;
    protected $em;

    /**
     * AuthenticationSuccessListener constructor.
     *
     * @param Request $request
     */
    public function __construct(RequestStack $request, EntityManagerInterface $em)
    {
        $this->request = $request->getCurrentRequest();
        $this->em = $em;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     * @throws
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        /* @var \App\Entity\Usuario $user */
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        /*$user->setFechaUltimoAcceso(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();

        $data['id'] = $user->getId();
        $data['nombre'] = $user->getNombre();
        $data['rol'] = $user->getRol()->getId();
        $data['foto'] = $user->getFoto() ? ['id' => $user->getFoto()->getId()] : '';
        $data['ctaCte'] = $user->isCtaCte();*/
        $event->setData($data);
    }
}
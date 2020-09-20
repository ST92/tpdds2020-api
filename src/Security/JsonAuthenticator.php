<?php

namespace App\Security;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JsonAuthenticator extends AbstractGuardAuthenticator
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;


    /**
     *
     * @var Container
     */
    protected $container;

    /**
     * Default message for authentication failure.
     *
     * @var string
     */
    private $failMessage = 'Invalid credentials';


    /**
     * Creates a new instance of JsonAuthenticator
     */

    public function __construct(RouterInterface $router, EntityManagerInterface $em, Container $container)
    {
        $this->router = $router;
        $this->em = $em;
        $this->container = $container;
    }

    /**
     *  {@inheritdoc}
     */
    public function supports(Request $request)
    {
        return $request->getPathInfo() == '/api/login' && $request->isMethod('POST');
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/api/login' || !$request->isMethod('POST')) {
            return;
        }

        $email = $request->request->get('_email');
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        $password = $request->request->get('_password');

        return array(
            'email' => $email,
            'password' => $password
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            $email = $credentials['email'];

            $userRepo = $this->em->getRepository('App:Usuario');

            $user = $userRepo->findOneBy(array('email' => $email, 'activo' => true, 'fechaBorrado' => null));

            if ($user) {
                return $user;
            } else {
                throw new UsernameNotFoundException();
            }
        } catch (UsernameNotFoundException $e) {
            throw new CustomUserMessageAuthenticationException($this->failMessage);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {

        $plainPassword = $credentials['password'];

        $encoder = $this->container->get('security.password_encoder');

        if (!$encoder->isPasswordValid($user, $plainPassword)) {
            throw new CustomUserMessageAuthenticationException($this->failMessage);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        $email = $request->request->get('_email');
        $userRepo = $this->em->getRepository('App:Usuario');

        $usuario = $userRepo->findOneBy(array('email' => $email));
        $usuario->setFechaUltimoAcceso(new \DateTime());

        $this->em->persist($usuario);
        $this->em->flush();

        $data = [
            'id' => $usuario->getId(),
            'nombre' => $usuario->getNombre(),
            'rol' => $usuario->getRol()->getId(),
            'foto' => $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/data/fotos/' . $usuario->getFoto()->getArchivo(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new JsonResponse(['message' => 'Email o Clave incorrectos.'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            // you might translate this message
            'message' => 'Autenticación requerida.'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return false;
    }
}

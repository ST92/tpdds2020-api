<?php

namespace App\Controller;

use App\Entity\CtaCteItem;
use App\Entity\MedioPago;
use App\Entity\Rol;
use App\Entity\Usuario;
use App\Form\CtaCteItemType;
use App\Form\UsuarioType;
use App\Form\UsuarioRegistroType;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @RouteResource("Usuarios", pluralize=false)
 */
class UsuariosController extends FOSRestController
{

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * Devuelve los usuarios
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @View()
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="100", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     * @QueryParam(name="operators", nullable=true, description="Operator by fields. Must be an array ie. &operators[id]=>")
     *
     * @return array
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $order_by = !is_null($paramFetcher->get('order_by')) ? $paramFetcher->get('order_by') : array();
        $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();
        $operators = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('operators') : array();

        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository(Usuario::class)->countByGrid($filters, $operators);
        return [
            'items' => $em->getRepository(Usuario::class)->findByGrid($filters, $operators, $order_by, $limit, $offset),
            'summary' => [$count],
            'totalCount' => $count
        ];
    }

    /**
     * Devuelve el usuario logueado
     *
     * @return Usuario
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_CADETE') or has_role('ROLE_USUARIO')")
     */
    public function getMeAction()
    {
        return $this->getUser();
    }

    /**
     * Devuelve un usuario
     *
     * @param Usuario $usuario
     *
     * @return Usuario
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getAction(Usuario $usuario)
    {
        return $usuario;
    }

    /**
     * Crear un nuevo Usuario desde Admin.
     *
     * @param Request $request
     *
     * @return FormInterface|Usuario
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @throws
     */
    public function postAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $objForm = $this->createForm(UsuarioType::class, $usuario, ['em' => $em]);
        $objForm->handleRequest($request);

        $usuario->setPassword(trim($objForm->get('password')->getData()));
        if ($objForm->isSubmitted() && $objForm->isValid()) {
            $usuario->setPassword($this->encoderFactory->getEncoder($usuario)->encodePassword($usuario->getPassword(), $usuario->getSalt()));
            $em->persist($usuario);


            if ($usuario->isCtaCte()) {
                $ctaCteItem = new CtaCteItem();
                $ctaCteItem->setUsuario($usuario);
                $ctaCteItem->setFecha(new \DateTime());
                $ctaCteItem->setDetalle('APERTURA CTA CTE');
                $ctaCteItem->setMonto(0);
                $ctaCteItem->setSaldo(0);
                $em->persist($ctaCteItem);
            }

            $em->flush();

            // Enviar email.
            // Creo un hash para validar la operación.
            $hash = sha1($usuario->getNombre() . $usuario->getEmail() . $usuario->getSalt());

            $message = (new \Swift_Message())
                ->setSubject('¡Te damos la bienvenida a DELIVERY CLUB! Por favor, confirma tu registro.')
                ->setFrom(getenv('EMAIL_FROM'), getenv('EMAIL_FROM_NAME'))
                ->setTo(getenv('APP_ENV') == 'dev' ? getenv('EMAIL_TO') : $usuario->getEmail())
                ->setBody(
                    $this->render(
                        'email/bienvenida.html.twig',
                        [
                            'usuario' => $usuario->getNombre(),
                            'url' => $this->generateUrl(
                                    'validaremail_usuarios',
                                    array(),
                                    UrlGeneratorInterface::ABSOLUTE_URL
                                ) . '?email=' . $usuario->getEmail() . '&c=' . $hash,
                            'base_url' => getenv('BASE_URL')
                        ]
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $usuario;
        }

        return $objForm;
    }

    /**
     * Crear un nuevo Usuario desde Anónimo.
     *
     * @param Request $request
     *
     * @return FormInterface|array
     *
     * @View()
     */
    public function postRegistroAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setRol($em->getReference(Rol::class, Rol::ROLE_USUARIO));
        $objForm = $this->createForm(UsuarioRegistroType::class, $usuario, ['em' => $em]);
        $objForm->remove('foto');
        $objForm->handleRequest($request);

        $usuario->setPassword(trim($objForm->get('password')->getData()));
        if ($objForm->isSubmitted() && $objForm->isValid()) {
            $usuario->setPassword($this->encoderFactory->getEncoder($usuario)->encodePassword($usuario->getPassword(), $usuario->getSalt()));
            $em->persist($usuario);
            $em->flush();

            // Enviar email.
            // Creo un hash para validar la operación.
            $hash = sha1($usuario->getNombre() . $usuario->getEmail() . $usuario->getSalt());

            $message = (new \Swift_Message())
                ->setSubject('¡Te damos la bienvenida a DELIVERY CLUB! Por favor, confirma tu registro.')
                ->setFrom(getenv('EMAIL_FROM'), getenv('EMAIL_FROM_NAME'))
                ->setTo(getenv('APP_ENV') == 'dev' ? getenv('EMAIL_TO') : $usuario->getEmail())
                ->setBody(
                    $this->render(
                        'email/bienvenida.html.twig',
                        [
                            'usuario' => $usuario->getNombre(),
                            'url' => $this->generateUrl(
                                    'validaremail_usuarios',
                                    array(),
                                    UrlGeneratorInterface::ABSOLUTE_URL
                                ) . '?email=' . $usuario->getEmail() . '&c=' . $hash,
                            'base_url' => getenv('BASE_URL')
                        ]
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return ['success' => true];
        }

        return $objForm;
    }

    /**
     * Edita un Usuario
     *
     * @param Request $request
     * @param Usuario $usuario
     *
     * @return FormInterface|Usuario
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_USUARIO')")
     * @throws
     */
    public function putAction(Request $request, Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();

        $ctaCteAnterior = $usuario->isCtaCte();

        $usuarioLogueado = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $this->getUser()->getEmail(),
            'fechaBorrado' => null
        ]);

        if ($usuarioLogueado->getRol()->getId() == Rol::ROLE_ADMIN) {
            $objForm = $this->createForm(UsuarioType::class, $usuario, ['method' => $request->getMethod(), 'em' => $em]);
        } else if ($usuarioLogueado->getRol()->getId() == Rol::ROLE_USUARIO && $usuarioLogueado->getEmail() == $usuario->getEmail()) {
            $objForm = $this->createForm(UsuarioRegistroType::class, $usuario, ['method' => $request->getMethod(), 'em' => $em]);
            $objForm->remove('email');
        } else {
            throw $this->createNotFoundException();
        }
        $objForm->handleRequest($request);

        if ($objForm->isSubmitted() && $objForm->isValid()) {
            if (trim($objForm->get('password')->getData()) != '') {
                $usuario->setPassword($this->encoderFactory->getEncoder($usuario)->encodePassword($usuario->getPassword(), $usuario->getSalt()));
            }

            // Si admin selecciona cta cte y el usuario antes no tenía, se crea la cta cte.
            if ($ctaCteAnterior == 0 && $usuario->isCtaCte()) {
                $ctaCteItem = new CtaCteItem();
                $ctaCteItem->setUsuario($usuario);
                $ctaCteItem->setFecha(new \DateTime());
                $ctaCteItem->setDetalle('APERTURA CTA CTE');
                $ctaCteItem->setMonto(0);
                $ctaCteItem->setSaldo(0);
                $em->persist($ctaCteItem);
            }

            $em->flush();
            return $usuario;
        }
        return $objForm;
    }

    /**
     * Devuelve los items de una cuenta corriente que pertenecen a un Usuario
     *
     * @param Usuario $usuario
     * @param ParamFetcherInterface $paramFetcher
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="100", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     * @QueryParam(name="operators", nullable=true, description="Operator by fields. Must be an array ie. &operators[id]=>")
     *
     * @return array
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_USUARIO')")
     */
    public function getCtacteAction(Usuario $usuario, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $order_by = !is_null($paramFetcher->get('order_by')) ? $paramFetcher->get('order_by') : array();
        $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();
        $operators = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('operators') : array();

        $em = $this->getDoctrine()->getManager();

        $usuarioLogueado = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $this->getUser()->getEmail(),
            'fechaBorrado' => null
        ]);

        if ($usuarioLogueado->getRol()->getId() == Rol::ROLE_ADMIN) {
            $filters['usuario.id'] = $usuario->getId();
        } else if ($usuarioLogueado->getEmail() != $usuario->getEmail()) {
            throw $this->createNotFoundException();
        } else {
            $filters['usuario.id'] = $usuarioLogueado->getId();
        }

        $count = $em->getRepository(CtaCteItem::class)->countByGrid($filters, $operators);

        return [
            'items' => $em->getRepository(CtaCteItem::class)->findByGrid($filters, $operators, $order_by, $limit, $offset),
            'summary' => [$count],
            'totalCount' => $count
        ];
    }

    /**
     * Crear un nuevo item de una cuenta corriente
     *
     * @param Request $request
     * @param Usuario $usuario
     *
     * @return FormInterface|CtaCteItem
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @throws
     */
    public function postCtacteAction(Request $request, Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();

        $saldo = $em->getRepository(CtaCteItem::class)->findBy(['usuario' => $usuario], ['id' => 'DESC'], 1)[0]->getSaldo();

        $ctaCteItem = new CtaCteItem();
        $ctaCteItem->setUsuario($usuario);
        $ctaCteItem->setFecha(new \DateTime());
        $ctaCteItem->setSaldo($saldo + $request->get('monto'));
        $objForm = $this->createForm(CtaCteItemType::class, $ctaCteItem, ['em' => $em]);
        $objForm->handleRequest($request);

        if ($objForm->isSubmitted() && $objForm->isValid()) {
            $em->persist($ctaCteItem);
            $em->flush();
            return $ctaCteItem;
        }
        return $objForm;
    }

    /**
     * Envía email para recuperar la contraseña de un Usuario
     *
     * @param Request $request
     *
     * @return array
     */
    public function postRecuperarclaveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $request->get('email'),
            'fechaBorrado' => null
        ]);

        if (!$usuario || $usuario->getRol() == Rol::ROLE_ADMIN || $usuario->getRol() == Rol::ROLE_CADETE) {
            throw $this->createNotFoundException();
        }

        // Enviar email.
        // Creo un hash para validar la operación.
        $hash = sha1($usuario->getEmail() . $usuario->getFechaModificado()->format('Y-m-d H:i:s') . $usuario->getId());

        $message = (new \Swift_Message())
            ->setSubject('Recuperación de clave de acceso a Delivery Club')
            ->setFrom(getenv('EMAIL_FROM'), getenv('EMAIL_FROM_NAME'))
            ->setTo(getenv('APP_ENV') == 'dev' ? getenv('EMAIL_TO') : $usuario->getEmail())
            ->setBody(
                $this->render(
                    'email/recuperarclave.html.twig',
                    [
                        'usuario' => $usuario->getNombre(),
                        'url' => getenv('APP_URL') . '/recuperar-clave?email=' . $usuario->getEmail() . '&c=' . $hash,
                        'base_url' => getenv('BASE_URL')
                    ]
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        return ['success' => true];
    }

    /**
     * Cambia la contraseña de un Usuario
     *
     * @param Request $request
     *
     * @return array
     */
    public function postNuevaclaveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $request->get('email'),
            'fechaBorrado' => null
        ]);

        if (!$usuario || $usuario->getRol() == Rol::ROLE_ADMIN || $usuario->getRol() == Rol::ROLE_CADETE) {
            throw $this->createNotFoundException();
        }

        // Comparo que el hash sea correcto
        $urlHash = $request->query->get('c');
        $hash = sha1($usuario->getEmail() . $usuario->getFechaModificado()->format('Y-m-d H:i:s') . $usuario->getId());

        if ($urlHash === $hash) {
            $usuario->setPassword($this->encoderFactory->getEncoder($usuario)->encodePassword($request->get('password'), $usuario->getSalt()));

            $em->persist($usuario);
            $em->flush();
        } else {
            throw $this->createNotFoundException();
        }

        return ['success' => true];
    }

    /**
     * Devuelve los medios de pago que tiene un Usuario
     *
     * @param Usuario $usuario
     *
     * @return array
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_USUARIO')")
     */
    public function getMediospagoAction(Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();

        $usuarioLogueado = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $this->getUser()->getEmail(),
            'fechaBorrado' => null
        ]);

        if ($usuarioLogueado->getRol()->getId() == Rol::ROLE_USUARIO && $usuarioLogueado->getEmail() != $usuario->getEmail()) {
            throw $this->createNotFoundException();
        }

        $mediosPago = $em->getRepository(MedioPago::class)->findAll();
        $retorno = array();

        if (!$usuario->isCtaCte()) {
            foreach ($mediosPago as $medioPago) {
                if ($medioPago->getId() != MedioPago::CUENTA_CORRIENTE) {
                    $retorno[] = $medioPago;
                }
            }
            $mediosPago = $retorno;
        }

        return $mediosPago;
    }

    /**
     * Maneja la validación del email de un Usuario
     *
     * @param Request $request
     *
     * @return Response
     */
    public function validaremailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository(Usuario::class)->findOneBy([
            'email' => $request->get('email'),
            'fechaBorrado' => null
        ]);

        if ($usuario) {
            // Comparo que el hash sea correcto
            $urlHash = $request->query->get('c');
            $hash = sha1($usuario->getNombre() . $usuario->getEmail() . $usuario->getSalt());

            if ($urlHash === $hash) {
                $em = $this->getDoctrine()->getManager();

                $usuario->setEmailValidado(true);

                $em->persist($usuario);
                $em->flush();
            } else {
                throw $this->createNotFoundException();
            }
        } else {
            throw $this->createNotFoundException();
        }

        return new RedirectResponse(getenv('APP_URL') . '?email=ok');
    }

    /**
     * Validar que un email sea único
     *
     * @param Request $request
     *
     * @return array
     *
     * @View()
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_USUARIO')")
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function esemailunicoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Usuario $usuario */
        $usuario = $em->getRepository(Usuario::class)->findOneByEmail($request->query->get('email'));

        if ($usuario) {
            if ($usuario->getId() == $request->query->get('id')) { // SE COMPARA ASI MISMO
                return ['unico' => true];
            }
            return ['unico' => false];
        }
        return ['unico' => true];
    }
}
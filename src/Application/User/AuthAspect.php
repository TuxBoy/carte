<?php
namespace App\User;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Psr\Container\ContainerInterface;
use TuxBoy\Redirect;
use TuxBoy\Router\Router;
use TuxBoy\Session\FlashService;
use TuxBoy\Session\SessionInterface;

class AuthAspect implements Aspect
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var FlashService
     */
    private $flash;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AuthAspect constructor.
     * @param ContainerInterface $container
     * @param SessionInterface $session
     * @param Router $router
     * @param FlashService $flash
     */
    public function __construct(
        ContainerInterface $container,
        SessionInterface $session,
        Router $router,
        FlashService $flash
    ) {
        $this->router = $router;
        $this->session = $session;
        $this->flash = $flash;
        $this->container = $container;
    }

		/**
		 * @param MethodInvocation $invocation
		 *
		 * @return void
		 * @throws \Psr\Container\ContainerExceptionInterface
		 * @throws \Psr\Container\NotFoundExceptionInterface
		 * @Before("execution(public App\*\Controller\Admin\*->*(*)) || execution(public App\Admin\Controller\*->*(*))")
		 */
    public function allowAdminAccess(MethodInvocation $invocation)
    {
        $authService = $this->container->get(AuthService::class);
        if (!$authService->getUser()) {
            $this->flash->error('Il faut être connecté pour accéder à cette page.');
            header('Location:' . '/login'); exit();
        } elseif ($authService->getUser() && $authService->getUser()->get('role') !== 'admin') {
            $this->flash->error('Il faut être admin pour accéder à cette page.');
            header('Location:' . '/'); exit();
        }
    }

		/**
		 * Est Exécuté avant la méthode login, si on est déjà connecté, on refuse l'accès à cette page
		 *
		 * @param MethodInvocation $invocation
		 * @throws \Psr\Container\ContainerExceptionInterface
		 * @throws \Psr\Container\NotFoundExceptionInterface
		 * @Before("execution(public App\*\Controller\*->login(*))")
		 */
    public function allowLoginAccess(MethodInvocation $invocation)
		{
				$authService = $this->container->get(AuthService::class);
				if ($authService->getUser()) {
						$this->flash->error('Vous êtes déjà connecté.');
						header('Location:' . '/'); exit();
				}
		}


}
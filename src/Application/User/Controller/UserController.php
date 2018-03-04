<?php
namespace App\User\Controller;

use App\User\AuthService;
use App\User\Entity\User;
use App\User\Form\UserForm;
use App\User\Table\UsersTable;
use GuzzleHttp\Psr7\ServerRequest;
use TuxBoy\Builder\Builder;
use TuxBoy\Controller\Controller;
use TuxBoy\Controller\Http;
use TuxBoy\Router\Router;
use TuxBoy\Tools\Password;

class UserController extends Controller
{

		/**
		 * @param ServerRequest $request
		 * @param UserForm $form
		 * @param Router $router
		 * @param AuthService $auth
		 * @return string
		 * @throws \Twig_Error_Loader
		 * @throws \Twig_Error_Runtime
		 * @throws \Twig_Error_Syntax
		 */
    public function login(ServerRequest $request, UserForm $form, Router $router, AuthService $auth)
    {
        if ($request->getMethod() === Http::POST) {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            if ($auth->login($username, $password)) {
                $this->flash->success('Vous êtes maintenant connecté.');
                return $this->redirectTo($router->generateUri('root'));
            } else {
                $this->flash->error('Votre login et mot de passe ne correspondent pas.');
            }
        }
        return $this->view->render('@user/login.twig', [
            'user'     => Builder::create(User::class),
            'userForm' => $form->formLogin()
        ]);
    }

    /**
     * @param AuthService $authService
     * @param Router $router
     * @return \GuzzleHttp\Psr7\MessageTrait
     */
    public function logout(AuthService $authService, Router $router)
    {
        $authService->logout();

        $this->flash->success('Vous êtes maintenant déconnecté.');
        return $this->redirectTo($router->generateUri('root'));
    }

	/**
	 * @return string
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
    public function register(): string
		{
			$user = Builder::create(User::class);
			return $this->view->render('@user/register.twig', compact('user'));
		}

		/**
		 * Permet de créer un compte utilisateur
		 * TODO Cette action n'est pas terminé, il manque la validation des données
		 *
		 * @param ServerRequest $request
		 * @param UsersTable $usersTable
		 * @param Router $router
		 * @return \GuzzleHttp\Psr7\MessageTrait
		 */
		public function registerForm(ServerRequest $request, UsersTable $usersTable, Router $router)
		{
				if ($request->getMethod() === Http::POST) {
						$user = Builder::create(User::class, [$request->getParsedBody()]);
						$usersTable->saveOrFail($user);
						$this->flash->success('Le compte a bien été créé');
						return $this->redirectTo($router->generateUri('root'));
				}
		}

}
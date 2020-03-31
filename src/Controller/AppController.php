<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use App\Controller\Component\ORMComponent;
use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * @property ORMComponent ORM
 */
class AppController extends Controller
{
    public $controller;
    public $action;
    public $controllerAction;
    public $isLogin;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        // Form authentication
        $this->loadComponent('Auth', [
            'loginAction' => ['controller' => 'Web', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Account', 'action' => 'index'],
            'logoutRedirect' => ['controller' => 'Web', 'action' => 'login'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'],
                    'userModel' => 'Account',
                    'passwordHasher' => ['className' => 'Default']
                ]
            ],
            'authError' => false
        ]);

        $this->controller = $this->request->getParam('controller');
        $this->action = $this->request->getParam('action');
        $this->controllerAction = $this->request->getParam('controller') . DS . $this->request->getParam('action');

        // Check account login front
        $this->isLogin = $this->Auth->user() ?? null;
        $this->set('isLogin', $this->isLogin);
    }

    public function beforeFilter(EventInterface $event)
    {
        $this->request->getSession()->delete('Flash');
    }

    public function beforeRender(EventInterface $event)
    {
        if ($this->controllerAction === 'Web/login') {
            $this->viewBuilder()->setLayout('login');
        } else {
            $this->viewBuilder()->setLayout('front');
        }

        $this->set('controller', $this->controller);
        $this->set('action', $this->action);
        $this->set('controllerAction', $this->controllerAction);
    }

    public function clearCookieSessionOnLogOut()
    {
        $this->request->getSession()->clear();
    }
}

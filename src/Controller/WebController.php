<?php

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use App\Model\Table\AccountTable;

/**
 * WebController
 *
 * @property AccountTable Account
 */
class WebController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Account');
    }

    public function login()
    {
        if ($this->Auth->user()
            && $this->request->is('post')
            && $this->Auth->user('email') !== $this->request->getData('email')
        ) {
            $this->Flash->error(MSG_LOGIN_ON_ONE_BROWSER, ['key' => 'msgLogin']);
            return;
        } else {
            // Redirect to home if user logon
            if ($this->Auth->user()) {
                $this->redirect($this->Auth->redirectUrl());
            }

            if (!$this->Auth->user() && $this->request->is('post')) {
                $data = $this->request->getData();
                $user = $this->Account->getAccountByEmail($data);
                if ($user && (new DefaultPasswordHasher)->check(trim($this->request->getData('password')), $user['password'])) {
                    $this->Auth->setUser($user);
                    $this->redirect($this->Auth->redirectUrl());
                    return;
                }

                // Set error message when login fail
                $this->Flash->error(MSG_LOGIN_FAILED, ['key' => 'msgLogin']);
            }
        }
    }

    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        if ($this->request->getSession()->check(MIDDLEWARE_MESSAGE_FLASH)) {
            $this->Flash->success($this->request->getSession()->consume(MIDDLEWARE_MESSAGE_FLASH), ['key' => 'middleware']);
        }
    }
}

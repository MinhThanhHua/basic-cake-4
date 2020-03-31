<?php

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use App\Model\Table\AccountTable;

/**
 * AccountController
 *
 * @property AccountTable Account
 */
class AccountController extends AppController
{
    public $paginate = [
        'limit' => DEFAULT_LIMIT_PAGINATE,
        'order' => ['created_at' => 'DESC']
    ];

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Account');
    }

    public function index()
    {
        try {
            $data = $this->request->getQuery();
            $session = $this->request->getSession();
            if (isset($data['limit'])) {
                if (!in_array($data['limit'], LIST_OPTION_PAGINATE)) {
                    $this->redirect(['controller' => 'Master', 'action' => 'index']);
                } else {
                    $this->paginate['limit'] = $data['limit'];
                }
            }

            if (count($data) > 0) {
                $listMaster = $this->paginate($this->Account->getAccountByConditions($data));
            } else {
                $listMaster = $this->paginate($this->Account->getAccountByConditions());
            }

            if ($session->check(SUCCESS_DATA_INPUT)) {
                $this->Flash->success($session->consume(SUCCESS_DATA_INPUT), ['key' => 'success']);
            }
            $this->set(compact('listMaster', 'data'));
        } catch (\Exception $e) {
            $this->log($e);
            if (isset($data['page'])) {
                $this->redirect(['controller' => 'Master', 'action' => 'index']);
            }
        }
    }
}

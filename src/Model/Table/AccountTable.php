<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Account Model
 */
class AccountTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('account');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }

    public function getAccountByEmail($data)
    {
        return $this->find('all')->where([
            'BINARY LOWER(email) =' => trim(strtolower($data['email']))
        ])->first();
    }

    public function getAccountByConditions($conditions = [])
    {
        if (count($conditions) > 0) {
            if (isset($conditions['where']['id'])) {
                $conditions['id'] = $conditions['where']['id'];
            }
            if (isset($conditions['where']['email'])) {
                $conditions['BINARY LOWER(email)'] = trim(strtolower($conditions['where']['email']));
            }
        }

        return $this->find()
            ->select($conditions['select'] ?? [])
            ->join($conditions['join'] ?? [])
            ->where($conditions['where'])
            ->offset($conditions['offset'] ?? 0)
            ->order($conditions['order'] ?? []);
    }
}

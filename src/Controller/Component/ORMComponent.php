<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Database\Connection;
use Cake\ORM\TableRegistry;

/**
 * DateTime component
 */
class ORMComponent extends Component
{
    public function transactional(callable $transaction, $useSavePoints = false)
    {
        /** @var Connection $connection */
        $connection = TableRegistry::get('App')->getConnection();
        $connection->enableSavePoints($useSavePoints);
        return $connection->transactional($transaction);
    }
}

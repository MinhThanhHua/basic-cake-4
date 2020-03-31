<?php

namespace App\Model\Table;

use Cake\Database\Connection;
use Cake\ORM\Table;

class AppTable extends Table
{
    /** @var Connection */
    protected $connection;

    public function initialize(array $config): void
    {
        $this->connection = $this->getConnection();

        $this->addBehavior('Updater');
    }
}

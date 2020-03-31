<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AccountV1 extends AbstractMigration
{
    public function change()
    {
        $this->table('account', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string')
            ->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('role', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->create();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Account seed.
 */
class AccountSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'id' => 1,
            'email' => 'admin@admin.com',
            'password' => (new DefaultPasswordHasher)->hash('123456'),
            'name' => 'nam_boy_chicken_plus',
            'role' => 1
        ];
        $table = $this->table('account');
        $table->insert($data)->save();
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'fullname' => 'Administrator',
            'username' => 'administrator',
            'password' => password_hash('administrator', PASSWORD_DEFAULT),
            'role' => 'Administrator'
        ];

        $this->db->table('user')->insert($data);
    }
}

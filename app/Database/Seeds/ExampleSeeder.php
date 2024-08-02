<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Example',
            'email' => 'user@example.com',
            'phonenumber' => '6282123456789',
            'address' => 'Indonesia',
            'image' => ''
        ];

        $this->db->table('example')->insert($data);
    }
}

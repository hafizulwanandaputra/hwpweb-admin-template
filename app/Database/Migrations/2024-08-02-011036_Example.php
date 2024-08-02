<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Example extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 24,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '512',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '512',
            ],
            'phonenumber' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '512',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('example');
    }

    public function down()
    {
        $this->forge->dropTable('example');
    }
}

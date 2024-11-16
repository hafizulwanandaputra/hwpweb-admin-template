<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSession extends Migration
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
            'id_user' => [
                'type'       => 'BIGINT',
                'constraint' => 24,
                'unsigned'   => true,
            ],
            'session_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'expires_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Set foreign key to users table
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('user_sessions');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('user_sessions', true);
    }
}

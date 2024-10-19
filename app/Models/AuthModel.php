<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = false;
    protected $allowedFields = ['fullname', 'username', 'password', 'role'];
    public function login($username)
    {
        return $this->db->table('user')->where([
            'username' => $username
        ])->get()->getRowArray();
    }
}

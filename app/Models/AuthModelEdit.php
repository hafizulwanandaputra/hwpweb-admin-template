<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModelEdit extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = false;
    protected $allowedFields = ['fullname', 'username', 'role'];
}

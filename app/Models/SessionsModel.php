<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionsModel extends Model
{
    protected $table = 'user_sessions';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_user', 'session_token', 'user_agent', 'ip_address', 'created_at', 'expires_at'];
}

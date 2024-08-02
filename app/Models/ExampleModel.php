<?php

namespace App\Models;

use CodeIgniter\Model;

class ExampleModel extends Model
{
    protected $table = 'example';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['name', 'email', 'phonenumber', 'address', 'image'];
}

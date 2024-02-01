<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'username', 'email', 'password', 'image', 'role'];

    public function getUser($username)
    {

        return $this->where(['username' => $username])->first();
    }
}

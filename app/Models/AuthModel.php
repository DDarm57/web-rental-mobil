<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function loginAdmin($username, $password)
    {
        return $this->db->table('user')->where([
            'username' => $username,
            'password' => $password
        ])->get()->getRowArray();
    }
}

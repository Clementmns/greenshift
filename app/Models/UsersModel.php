<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'user';

    public function getUsers()
    {

        $results = $this->orderby('', 'ASC');
        $results = $this->find();

        return $results;
    }
}

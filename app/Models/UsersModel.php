<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';

    public function getUsers()
    {

        $results = $this->orderby('', 'ASC');
        $results = $this->find();

        return $results;
    }
}

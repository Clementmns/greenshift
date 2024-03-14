<?php

namespace App\Models;

use CodeIgniter\Model;

class FriendRelation extends Model
{
    protected $table            = 'greenshift_relation';
    protected $primaryKey       = 'id_relation';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_relation', 'fk_user', 'fk_userfollowed'];

    public function addRelation($userId, $friendId)
    {
        try {

            return $this->insert([
                'fk_user' => $userId,
                'fk_userfollowed' => $friendId,
            ]);
        } catch (\Exception $e) {

            // Rethrow the exception
            throw $e;
        }
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'greenshift_users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['lastname', 'firstname', 'password', 'pseudo', 'avatar', 'goals', 'points', 'exp', 'level'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // 
    // Récupération de données
    // 

    // Le classement de l'utilisateur amical (ex : 1 parmi ses amis) -> requête SQL

    public function getFriendsRanking($id_user)
    {
        $builder = $this->db->table("greenshift_users");

        $builder->select("id_user, firstname, lastname, greenshift_users.pseudo, greenshift_users.avatar, greenshift_users.points, greenshift_users.exp, greenshift_users.level");
        $builder->join("greenshift_relation", "greenshift_users.id_user = greenshift_relation.fk_user OR greenshift_users.id_user = greenshift_relation.fk_userfollowed", "inner");
        $builder->where("(greenshift_relation.fk_user = $id_user)");
        $builder->orderBy("greenshift_users.points", "DESC");
        $builder->orderBy("greenshift_users.exp", "DESC");
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }



    // Le classement de l'utilisateur mondial (ex : 34 / le nb total d'utilisateur)
    public function getWorldRanking()
    {
        $builder = $this->db->table("greenshift_users");

        $builder->select("greenshift_users.id_user, greenshift_users.firstname, greenshift_users.lastname, greenshift_users.pseudo, greenshift_users.avatar, greenshift_users.points, greenshift_users.exp, greenshift_users.level");
        $builder->orderBy("greenshift_users.level", "DESC");
        $builder->orderBy("greenshift_users.exp", "DESC"); // Tri par exp si le level est le même
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }


    // Suggestions des relations
    public function searchUsers($searchTerm, $id_user)
    {
        // Exécuter la requête de recherche des utilisateurs
        $builder = $this->db->table('greenshift_users');
        $builder->select('id_user, firstname, lastname, greenshift_users.pseudo, greenshift_users.avatar, greenshift_users.points, greenshift_users.exp, greenshift_users.level');
        $builder->where("id_user !=", $id_user);
        $builder->groupStart(); // Début des conditions groupées
        $builder->like('pseudo', $searchTerm, 'both');
        $builder->orLike('firstname', $searchTerm, 'both');
        $builder->orLike('lastname', $searchTerm, 'both');
        $builder->groupEnd(); // Fin des conditions groupées

        $query = $builder->get();
        return $query->getResultArray();
    }

    // Récupérer le nombre de points d'un utilisateur
    public function getUserPoints($userId)
    {
        return $this->db->table('greenshift_users')
                        ->select('points')
                        ->where('id_user', $userId)
                        ->get()
                        ->getRowArray()['points'];
    }

    // Mettre à jour les points d'un utilisateur
    public function updatePoints($userId, $earning)
    {
        $currentUserPoints = $this->db->table('greenshift_users')
            ->select('points')
            ->where('id_user', $userId)
            ->get()
            ->getRowArray()['points'];

        $currentLevel = $this->db->table('greenshift_users')
            ->select('level')
            ->where('id_user', $userId)
            ->get()
            ->getRowArray()['level'];

        $currentExp = $this->db->table('greenshift_users')
            ->select('exp')
            ->where('id_user', $userId)
            ->get()
            ->getRowArray()['exp'];

        if ($currentExp + $earning >= ($currentLevel * 200 + 400)) {
            $newExp = $currentExp + $earning - ($currentLevel * 200 + 400);
            $newLevel = $currentLevel + 1;
        } else {
            $newExp = $currentExp + $earning;
            $newLevel = $currentLevel;
        }


        $newPoints = $currentUserPoints + $earning;

        return $this->db->table('greenshift_users')
            ->where('id_user', $userId)
            ->update(['points' => $newPoints, 'exp' => $newExp, 'level' => $newLevel]);
    }
}

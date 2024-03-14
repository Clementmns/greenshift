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

        $builder->select("greenshift_users.id_user,greenshift_users.firstname, greenshift_users.lastname, greenshift_users.pseudo, greenshift_users.avatar, greenshift_users.points, greenshift_users.exp, greenshift_users.level");

        $builder->join("greenshift_relation", "greenshift_users.id_user = greenshift_relation.fk_user", "inner");
        $builder->where("(greenshift_users.id_user = $id_user OR greenshift_relation.fk_userfollowed = $id_user)", NULL, FALSE);
        $builder->orderBy("greenshift_users.points", "DESC");
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }


    // Le classement de l'utilisateur mondial (ex : 34 / le nb total d'utilisateur)
    public function getWorldRanking()
    {
        $builder = $this->db->table("greenshift_users");

        $builder->select("greenshift_users.id_user,greenshift_users.firstname, greenshift_users.lastname, greenshift_users.pseudo, greenshift_users.avatar, greenshift_users.points, greenshift_users.exp, greenshift_users.level");
        $builder->orderBy("greenshift_users.points", "DESC");
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }

    // Suggestions des relations
    public function searchUsers($searchTerm, $id_user)
    {
        $builder = $this->db->table('greenshift_users');

        $builder->select('id_user, pseudo, avatar, level');
        $builder->like('pseudo', $searchTerm, 'left');
        $builder->where("id_user != $id_user");
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }

    // Tableau des badges de l'utilisateur (le lien du badge et titre)


    // Tableau des personnes que l'utilisateur follow
}

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
        $builder = $this->db->table('greenshift_goalsrealised as gr');
        $builder->select('g.id_user, u.firstname, u.lastname, COUNT(gr.id_goalrealised) as total');
        $builder->join('greenshift_goals as g', 'g.id_goal = gr.fk_goal');
        $builder->join('greenshift_users as u', 'u.id_user = gr.fk_user');
        $builder->join('greenshift_relation as r', 'r.fk_userfollowed = u.id_user', 'left');
        $builder->where('r.fk_user', $id_user);
        $builder->groupBy('g.id_user, u.firstname, u.lastname');
        $builder->orderBy('COUNT(gr.id_goalrealised)', 'DESC');

        $query = $builder->get();

        return $query->getResultArray();
    }


    // Le classement de l'utilisateur mondial (ex : 34 / le nb total d'utilisateur)

    // L'avatar (lien)

    // Tableau des badges de l'utilisateur (le lien du badge et titre)

    // Le nombre de points de l'utilisateur

    // Le niveau de l'utilisateur

    // L'exp de l'utilisateur

    // Tableau des personnes que l'utilisateur follow

    // Récupérer le tableau JSON de l'avancée des objectifs (greenshift_users->goals)
}

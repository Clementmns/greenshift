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


}   public function getFriendsRanking($id_user)
{
    $builder = $this->db->table('greenshift_goalsrealised');
    $builder->select('greenshift_goals.id_user, greenshift_users.firstname, greenshift_users.lastname, COUNT(greenshift_goalsrealised.id_goalrealised) as total');
    $builder->join('greenshift_goals', 'greenshift_goals.id_goal = greenshift_goalsrealised.fk_goal');
    $builder->join('greenshift_users', 'greenshift_users.id_user = greenshift_goalsrealised.fk_user');
    $builder->join('greenshift_relation', 'greenshift_relation.fk_userfollowed = greenshift_users.id_user', 'left');
    $builder->where('greenshift_relation.fk_user', $id_user);
    $builder->groupBy('greenshift_goals.id_user, greenshift_users.firstname, greenshift_users.lastname');
    $builder->orderBy('COUNT(greenshift_goalsrealised.id_goalrealised)', 'DESC');

    $query = $builder->get();

    return $query->getResultArray();



    // Le classement de l'utilisateur mondial (ex : 34 / le nb total d'utilisateur)

    // L'avatar (lien)

    // Tableau des badges de l'utilisateur (le lien du badge et titre)

    // Le nombre de points de l'utilisateur

    // Le niveau de l'utilisateur

    // L'exp de l'utilisateur

    // Tableau des personnes que l'utilisateur follow

    // Récupérer le tableau JSON de l'avancée des objectifs (greenshift_users->goals)
}

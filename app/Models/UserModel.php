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
        // Récupérer le prénom et le nom de famille de l'utilisateur en cours
        $userData = $this->select('firstname, lastname')->where('id_user', $id_user)->findAll();

        // Vérifier si des données utilisateur ont été trouvées
        // Extraire le prénom et le nom de famille
        $firstname = $userData[0]['firstname'];
        $lastname = $userData[0]['lastname'];

        // Retourner un tableau associatif contenant le prénom et le nom de famille



        // Exécuter la requête de recherche des utilisateurs
        $builder = $this->db->table('greenshift_users');
        $builder->select('id_user, pseudo, avatar, level');
        $builder->like('pseudo', $searchTerm, 'both');
        $builder->orLike('firstname', $searchTerm, 'both');
        $builder->orLike('lastname', $searchTerm, 'both');


        $builder->where("id_user != $id_user AND firstname != '$firstname' AND lastname != '$lastname'");
        $builder->distinct();
        $query = $builder->get();
        return $query->getResultArray();
    }


    // Récupérer le tableau JSON de l'avancée des objectifs (greenshift_users->goals)
    public function updatePoints($userId, $earning)
    {
        $currentUserPoints = $this->db->table('greenshift_users')
            ->select('points')
            ->where('id_user', $userId)
            ->get()
            ->getRowArray()['points'];

        $newPoints = $currentUserPoints + $earning;

        return $this->db->table('greenshift_users')
            ->where('id_user', $userId)
            ->update(['points' => $newPoints]);
    }
}

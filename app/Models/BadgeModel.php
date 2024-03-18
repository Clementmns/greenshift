<?php

namespace App\Models;

use CodeIgniter\Model;

class BadgeModel extends Model
{
    protected $table = 'greenshift_badges';
    protected $primaryKey = 'id_badge';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['title', 'price', 'link'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // 
    // Récupération de données
    // 

    // Récupérer toutes les infos tous les badges

    // Récupérer toutes les infos des badges obtenus de l'utilisateur

    // Méthode pour récupérer toutes les informations sur les badges
    public function getAllBadges()
    {
        return $this->findAll(); // Cela va récupérer tous les enregistrements de la table greenshift_badges
    }

    // Méthode pour récupérer toutes les informations des badges obtenus par un utilisateur spécifique
    public function getUserOwnedBadges($userId)
    {
        return $this->db->table('greenshift_ownedbadges')
                        ->select('greenshift_badges.*') // Sélectionne toutes les colonnes de greenshift_badges
                        ->join('greenshift_badges', 'greenshift_badges.id_badge = greenshift_ownedbadges.fk_badge')
                        ->where('greenshift_ownedbadges.fk_user', $userId)
                        ->get()
                        ->getResultArray();
    }

    // Méthode pour acheter un badge
    public function buyBadge($userId, $badgeId)
    {
        $badge = $this->find($badgeId);

        if (!$badge) {
            return false; // Le badge n'existe pas
        }

        $userPoints = $this->getUserPoints($userId);

        if ($userPoints < $badge['price']) {
            return false; // L'utilisateur n'a pas assez de points pour acheter le badge
        }

        // Soustraire le prix du badge des points de l'utilisateur
        $newPoints = $userPoints - $badge['price'];
        $this->updateUserPoints($userId, $newPoints);

        // Ajouter le badge à la liste des badges possédés par l'utilisateur
        $this->addUserBadge($userId, $badgeId);

        return true; // Le badge a été acheté avec succès
    }

    // Méthode pour récupérer les points de l'utilisateur
    protected function getUserPoints($userId)
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if ($user) {
            return $user['points'];
        } else {
            return false; // L'utilisateur n'existe pas
        }
    }

    // Méthode pour mettre à jour les points de l'utilisateur
    protected function updateUserPoints($userId, $newPoints)
    {
        $userModel = new UserModel();
        $userModel->update($userId, ['points' => $newPoints]);
    }

    // Méthode pour ajouter un badge à un utilisateur
    protected function addUserBadge($userId, $badgeId)
    {
        $data = [
            'fk_user' => $userId,
            'fk_badge' => $badgeId
        ];

        $this->db->table('greenshift_ownedbadges')->insert($data);
    }
}

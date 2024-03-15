<?php

namespace App\Models;

use CodeIgniter\Model;

class GoalRealisedModel extends Model
{
    protected $table            = 'greenshift_goalsrealised';
    protected $primaryKey       = 'id_goalrealised';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fk_user', 'fk_goal'];



    // Méthode pour insérer un nouvel enregistrement dans la table greenshift_goalrealised
    public function addGoalRealised($userId, $goalId)
    {
        try {
            // Débogage : Afficher les valeurs des variables
            log_message('debug', 'User ID in GoalRealisedModel: ' . $userId);
            log_message('debug', 'Goal ID in GoalRealisedModel: ' . $goalId);

            return $this->insert([
                'fk_user' => $userId,
                'fk_goal' => $goalId,
            ]);
        } catch (\Exception $e) {
            // Log the exception
            log_message('error', 'Error in addGoalRealised(): ' . $e->getMessage());

            // Rethrow the exception
            throw $e;
        }
    }

    // Méthode pour récupérer la valeur de l'objectif validé
    public function getGoalEarning($goalId)
    {
        return $this->db->table('greenshift_goals')
            ->select('earning')
            ->where('id_goal', $goalId)
            ->get()
            ->getRowArray()['earning'];
    }

    public function goalsRealised($userId)
    {
        $builder = $this->db->table('greenshift_goalsrealised');
        $builder->select('greenshift_goalsrealised.fk_goal, greenshift_goals.week, greenshift_goals.year, greenshift_goals.title, greenshift_goals.description, greenshift_goals.earning');
        $builder->join('greenshift_goals', 'greenshift_goals.id_goal = greenshift_goalsrealised.fk_goal');
        $builder->where('greenshift_goalsrealised.fk_user', $userId);
        $builder->distinct();

        $query = $builder->get();

        return $query->getResultArray();
    }
}

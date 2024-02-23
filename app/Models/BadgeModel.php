<?php

namespace App\Models;

use CodeIgniter\Model;

class BadgeModel extends Model
{
    protected $table            = 'greenshift_badges';
    protected $primaryKey       = 'id_badge';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'price', 'link'];

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

    // Le classement de l'utilisateur mondial (ex : 34 / le nb total d'utilisateur)

    // L'avatar (lien)

    // Tableau des badges de l'utilisateur (le lien du badge et titre)

    // Le nombre de points de l'utilisateur

    // Le niveau de l'utilisateur

    // L'exp de l'utilisateur

    // Tableau des personnes que l'utilisateur follow

    // Récupérer le tableau JSON de l'avancée des objectifs (greenshift_users->goals)
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantsModel extends Model
{
    protected $table = 'etudiant';

    public function getEtudiants()
    {

        $results = $this->orderby('nom_etudiant', 'ASC');
        $results = $this->find();

        return $results;
    }
}

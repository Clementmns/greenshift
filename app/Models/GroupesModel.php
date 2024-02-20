<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupesModel extends Model
{
   protected $table = 'groupe';

   public function getGroupes()
   {

      $results = $this->orderby('libelle_groupe', 'ASC');
      $results = $this->find();

      return $results;
   }

   public function getEtudiantsByIdGroupes($id_groupe)
   {
      $results = $this->join('inscription', 'groupe.id_groupe=inscription.groupe_id');
      $results = $this->join('etudiant', "etudiant.id_etudiant=inscription.etudiant_id");
      $results = $this->where('groupe.id_groupe', $id_groupe);
      $results = $this->orderBy('etudiant.nom_etudiant', 'ASC');
      $results = $this->find();

      return $results;
   }
}

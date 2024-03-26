<?php

namespace App\Controllers;

use App\Models\GoalModel;

class GoalController extends BaseController
{
   public function addGoals()
   {
      // Vérifier si la requête est de type AJAX et POST
      if ($this->request->isAJAX()) {
         // Récupérer les données du formulaire
         $goalData = [];
         for ($i = 1; $i <= 5; $i++) {
            $goalData[] = [
               'title' => $this->request->getPost('titre' . $i),
               'description' => $this->request->getPost('description' . $i),
               'earning' => $this->request->getPost('prix' . $i),
               'week' => date('W') + 1, // Semaine prochaine
               'year' => date('Y'), // Année en cours
            ];
         }

         // Ajouter les objectifs à la base de données
         $goalModel = new GoalModel();
         $goalModel->addGoals($goalData);

         // Redirection avec un message de succès
         return redirect()->to('/')->with('success', 'Objectifs ajoutés avec succès pour la semaine prochaine.');
      } else {
         // Redirection avec un message d'erreur si la requête n'est pas valide
         return redirect()->to('/')->with('error', 'Erreur lors de l\'ajout des objectifs. Veuillez réessayer.');
      }
   }
}

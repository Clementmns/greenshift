<?php

namespace App\Controllers;

use App\Models\GroupesModel;
use CodeIgniter\Controller;

class Groupes extends Controller
{
   public function index()
   {
      $model = model(GroupesModel::class);

      $data = [

         'groupes' => $model->getGroupes(),

         'title' => "Visualisation de tous les groupes de la BDD",
      ];

      echo view('templates/header', $data);
      echo view('groupes/view', $data);
      echo view('templates/footer', $data);
   }

   public function choose()
   {
      $model = model(GroupesModel::class);
      if (isset($_GET["groupe"])) {
         $groupe = $_GET["groupe"];
      } else {
         $groupe = "36";
      }


      $data = [

         'etudiantsByIdGroupes' => $model->getEtudiantsByIdGroupes($groupe),

         'title' => "Visualisation de tous les étudiants du groupe ",

         'groupe' => $groupe,
      ];

      echo view('templates/header', $data);
      echo view('groupes/etugrp', $data);
      echo view('templates/footer', $data);
   }
}

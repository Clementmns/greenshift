<?php

namespace App\Controllers;

use App\Models\EtudiantsModel;
use CodeIgniter\Controller;

class Etudiants extends Controller
{
    public function index()
    {
        $model = model(EtudiantsModel::class);

        $data = [

            'etudiants' => $model->getEtudiants(),

            'title' => "Visualisation de tous les étudiants de la BDD",
        ];

        echo view('templates/header', $data);
        echo view('etudiants/view', $data);
        echo view('templates/footer', $data);
    }
}

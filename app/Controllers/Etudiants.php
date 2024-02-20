<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function index()
    {
        $model = model(UsersModel::class);

        $data = [

            'etudiants' => $model->getEtudiants(),

            'title' => "Visualisation de tous les étudiants de la BDD",
        ];

        echo view('templates/header', $data);
        echo view('etudiants/view', $data);
        echo view('templates/footer', $data);
    }
}

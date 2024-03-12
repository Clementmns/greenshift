<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Friends_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Charger les modèles ou d'autres bibliothèques nécessaires ici
        $this->load->model('UserModel');
    }

    public function index()
    {
        // Récupérer l'ID de l'utilisateur actuel, vous pouvez le récupérer à partir de la session ou d'autres sources
        $id_user = 1;

        // Charger les données nécessaires depuis le modèle
        $friends_ranking = $this->UserModel->getFriendsRanking($id_user);

        // Préparer les données à transmettre à la vue
        $data['friends_ranking'] = $friends_ranking;

        // Charger directement la vue 'friends.php'
        $this->load->view('friends', $data);
        return view('classement/friend');
    }
}

<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\UserModel;

class Boutique extends BaseController
{
    public function index()
    {
        $badgeModel = new BadgeModel();
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        // Récupérer tous les badges disponibles
        $allBadges = $badgeModel->getAllBadges();

        // Récupérer les badges de l'utilisateur
        $userBadges = $badgeModel->getUserOwnedBadges($loggedInUserId);

        // Récupérer les points de l'utilisateur
        $userPoints = $userModel->getUserPoints($loggedInUserId);

        // Récupérer les badges favoris de l'utilisateur
        $userFavoriteBadges = $userModel->getUserFavoriteBadges($loggedInUserId);

        $data = [
            'allBadges' => $allBadges,
            'userBadges' => $userBadges,
            'userPoints' => $userPoints,
            'userFavoriteBadges' => $userFavoriteBadges, // Ajout de cette variable pour les favoris
        ];

        return view('boutique/index', $data);
    }

    // Méthode pour acheter un badge
    public function buyBadge($badgeId)
    {
        $badgeModel = new BadgeModel();
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        // Vérifier si l'utilisateur est connecté
        if (!$loggedInUserId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour acheter un badge.');
        }

        // Vérifier si le badge existe
        $badge = $badgeModel->find($badgeId);
        if (!$badge) {
            return redirect()->back()->with('error', 'Le badge que vous essayez d\'acheter n\'existe pas.');
        }

        // Vérifier si l'utilisateur a déjà acheté ce badge
        $userBadge = $badgeModel->userHasBadge($loggedInUserId, $badgeId);
        if ($userBadge) {
            return redirect()->back()->with('error', 'Vous avez déjà acheté ce badge.');
        }

        // Vérifier si l'utilisateur a suffisamment de points
        $userPoints = $userModel->getUserPoints($loggedInUserId);
        if ($userPoints < $badge['price']) {
            return redirect()->back()->with('error', 'Vous n\'avez pas assez de points pour acheter ce badge.');
        }

        // Acheter le badge
        $badgeModel->buyBadge($loggedInUserId, $badgeId);

        return redirect()->back()->with('success', 'Le badge a été acheté avec succès.');
    }

    // Méthode pour ajouter des badges aux favoris
    public function addFavoriteBadges()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        // Vérifier si l'utilisateur est connecté
        if (!$loggedInUserId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour ajouter un badge aux favoris.');
        }

        // Récupérer les badges sélectionnés à ajouter aux favoris
        if  (isset($_POST['favorite_badges'])){
            $favoriteBadges = $this->request->getPost('favorite_badges');

        // Ajouter chaque badge aux favoris de l'utilisateur
        foreach ($favoriteBadges as $badgeId) {
            $userModel->addFavoriteBadge($loggedInUserId, $badgeId);
        }
        return redirect()->back()->with('success', 'Les badges ont été ajoutés aux favoris avec succès.');
        }
        else{
            return redirect()->back()->with('error', "Les badges n'ont pas été ajoutés aux favoris avec succès.");
        }
        

        
    }
}

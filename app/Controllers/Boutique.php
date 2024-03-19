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

        $data = [
            'allBadges' => $allBadges,
            'userBadges' => $userBadges,
            'userPoints' => $userPoints,
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

        // Vérifier si l'utilisateur a suffisamment de points
        $userPoints = $userModel->getUserPoints($loggedInUserId);
        if ($userPoints < $badge['price']) {
            return redirect()->back()->with('error', 'Vous n\'avez pas assez de points pour acheter ce badge.');
        }

        // Acheter le badge
        $badgeModel->buyBadge($loggedInUserId, $badgeId);

        return redirect()->back()->with('success', 'Le badge a été acheté avec succès.');
    }
}

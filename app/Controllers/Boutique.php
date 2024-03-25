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
        $userInfo = $userModel->find($loggedInUserId);

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
            'userInfo' => $userInfo,
        ];

        return view('boutique/index', $data);
    }

    // Méthode pour acheter plusieurs badges
    public function buyBadges()
    {
        $badgeModel = new BadgeModel();
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        // Vérifier si l'utilisateur est connecté
        if (!$loggedInUserId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour acheter des badges.');
        }

        // Récupérer les badges sélectionnés à acheter
        $selectedBadges = $this->request->getPost('selected_badges');

        // Vérifier si des badges ont été sélectionnés
        if ($selectedBadges === null || empty($selectedBadges)) {
            return redirect()->back()->with('error', "Aucun badge n'a été sélectionné.");
        }

        // Acheter chaque badge sélectionné
        foreach ($selectedBadges as $badgeId) {
            // Vérifier si le badge existe
            $badge = $badgeModel->find($badgeId);
            if (!$badge) {
                return redirect()->back()->with('error', 'Le badge que vous essayez d\'acheter n\'existe pas.');
            }

            // Vérifier si l'utilisateur a déjà acheté ce badge
            $userBadge = $badgeModel->userHasBadge($loggedInUserId, $badgeId);
            if ($userBadge) {
                return redirect()->back()->with('error', 'Vous avez déjà acheté le badge "'.$badge['title'].'".');
            }

            // Vérifier si l'utilisateur a suffisamment de points
            $userPoints = $userModel->getUserPoints($loggedInUserId);
            if ($userPoints < $badge['price']) {
                return redirect()->back()->with('error', 'Vous n\'avez pas assez de points pour acheter le badge "'.$badge['title'].'".');
            }

            // Acheter le badge
            $badgeModel->buyBadge($loggedInUserId, $badgeId);
        }

        return redirect()->back()->with('success', 'Les badges sélectionnés ont été achetés avec succès.');
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
        $favoriteBadges = $this->request->getPost('favorite_badges');

        // Vérifier si des badges ont été sélectionnés
        if ($favoriteBadges === null || empty($favoriteBadges)) {
            return redirect()->back()->with('error', "Aucun badge n'a été sélectionné.");
        }

        // Récupérer les badges favoris actuels de l'utilisateur
        $userFavoriteBadges = $userModel->getUserFavoriteBadges($loggedInUserId);

        // Vérifier si l'utilisateur a déjà trois badges favoris
        if (count($userFavoriteBadges) >= 3) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas ajouter plus de trois badges aux favoris.');
        }

        // Ajouter chaque badge aux favoris de l'utilisateur
        foreach ($favoriteBadges as $badgeId) {
            $userModel->addFavoriteBadge($loggedInUserId, $badgeId);
        }

        return redirect()->back()->with('success', 'Les badges ont été ajoutés aux favoris avec succès.');
    }

    // Méthode pour supprimer un badge des favoris
    public function removeFavoriteBadges()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        // Vérifier si l'utilisateur est connecté
        if (!$loggedInUserId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour supprimer des badges des favoris.');
        }

        // Récupérer les badges sélectionnés à supprimer des favoris
        $favoriteBadgesToRemove = $this->request->getPost('favorite_badges_to_remove');

        // Vérifier si des badges ont été sélectionnés
        if ($favoriteBadgesToRemove === null || empty($favoriteBadgesToRemove)) {
            return redirect()->back()->with('error', "Aucun badge n'a été sélectionné pour être supprimé des favoris.");
        }

        // Supprimer chaque badge des favoris de l'utilisateur
        foreach ($favoriteBadgesToRemove as $badgeId) {
            $userModel->removeFavoriteBadge($loggedInUserId, $badgeId);
        }

        return redirect()->back()->with('success', 'Les badges sélectionnés ont été supprimés des favoris avec succès.');
    }
}

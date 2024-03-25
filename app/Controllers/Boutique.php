<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\UserModel;

class Boutique extends BaseController
{
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

<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use Exception;

class BadgeController extends BaseController
{
    public function addBadge()
    {
        // Vérifier si la requête est de type POST
        if ($this->request->isAJAX()) {
            // Valider le formulaire

            // Récupérer les données du formulaire
            $badgeData = [
                'title' => $this->request->getPost('titre'),
                'price' => $this->request->getPost('prix'),
                // Ajoutez d'autres champs de données ici si nécessaire
            ];

            // Télécharger l'image du badge et récupérer le chemin de l'image
            $badgeImagePath = $this->uploadBadgeImage();

            if ($badgeImagePath) {
                // Ajouter le chemin de l'image du badge aux données du badge
                $badgeData['link'] = $badgeImagePath;

                // Ajouter le badge à la base de données
                $badgeModel = new BadgeModel();
                $badgeModel->addBadge($badgeData);

                // Redirection avec un message de succès
                return redirect()->to('/')->with('success', 'Badge ajouté avec succès.');
            } else {
                // Gérer les erreurs de téléchargement de l'image du badge
                return redirect()->to('/')->with('error', 'Erreur lors du téléchargement de l\'image du badge.');
            }
        }

        // Afficher le formulaire d'ajout de badge
    }

    public function uploadBadgeImage()
    {
        try {
            // Obtenir l'image téléchargée
            $badgeImage = $this->request->getFile('image');

            // Vérifier si l'image est valide et non déplacée
            if ($badgeImage && $badgeImage->isValid() && !$badgeImage->hasMoved()) {
                // Définir le chemin de destination pour l'image du badge
                $destinationPath = ROOTPATH . 'public/assets/badges';

                // Vérifier si le répertoire de destination existe, sinon le créer
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Générer un nouveau nom de fichier pour l'image du badge
                $newFileName = 'badge_' . uniqid() . '.' . $badgeImage->getClientExtension();

                // Déplacer l'image vers le répertoire de destination avec le nouveau nom de fichier
                $badgeImage->move($destinationPath, $newFileName);

                // Retourner le chemin complet de l'image du badge téléchargée
                return $newFileName;
            } else {
                // Retourner une erreur si l'image n'est pas valide ou n'a pas été déplacée
                return false;
            }
        } catch (Exception $e) {
            // Gérer toute exception survenue pendant le téléchargement de l'image du badge
            return false;
        }
    }
}

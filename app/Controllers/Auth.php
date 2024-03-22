<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Extension;
use App\Libraries\Hash;
use App\Models\UserModel;
use Exception;

class Auth extends BaseController
{
   public function __construct()
   {
      helper(['url', 'form']);
   }

   public function index()
   {
      return view('auth/login');
   }

   public function register()
   {
      return view('auth/register');
   }

   public function registerUser()
   {

      function avatarGenerator($character)
      {
         $imageName = time() . rand(0, 999999) . ".png";
         $path = getcwd() . '/assets/avatar/' .  $imageName;
         $image = imagecreate(200, 200);

         $red = rand(0, 255);
         $green = rand(0, 255);
         $blue = rand(0, 255);

         imagecolorallocate($image, $red, $green, $blue);

         $textcolor = imagecolorallocate($image, 255, 255, 255);

         imagettftext($image, 100, 0, 55, 150, $textcolor, getcwd() . '/font/Arial.ttf', $character);

         header('Content-type: image/png');

         imagepng($image, $path);
         imagedestroy($image);

         return $imageName;
      }

      $validated = $this->validate([
         'firstname' => ['rules' => 'required', 'errors' => ['required' => 'Le prénom est requis',]],
         'lastname' => ['rules' => 'required', 'errors' => ['required' => 'Le nom est requis',]],
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Le pseudo complet est requis',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[30]', 'errors' => ['required' => 'Le mot de passe est requis', 'min_length' => 'Le mot de passe doit faire au moins 5 charactères', 'max_length' => 'Le mot de passe ne doit pas dépasser 30 charactères']],
         'passwordConf' => ['rules' => 'required|min_length[5]|max_length[30]', 'errors' => ['required' => 'Le mot de passe est requis', 'min_length' => 'Le mot de passe doit faire au moins 5 charactères', 'max_length' => 'Le mot de passe ne doit pas dépasser 30 charactères', 'matches' => 'Les mots de passe doivent être identiques']],
      ]);

      if (!$validated) {
         return view('auth/register', ['validation' => $this->validator]);
      }

      $firstname = $this->request->getPost('firstname');
      $lastname = $this->request->getPost('lastname');
      $pseudo = $this->request->getPost('pseudo');
      $password = $this->request->getPost('password');
      $passwordConf = $this->request->getPost('passwordConf');

      $initials = substr($firstname[0], 0, 1);


      $data = [
         'firstname' => $firstname,
         'lastname' => $lastname,
         'pseudo' => $pseudo,
         'password' => Hash::encrypt($password),
         'avatar' => avatarGenerator($initials),
      ];

      // Storing data

      $userModel = new \App\Models\UserModel();
      $query = $userModel->insert($data);

      return redirect()->to('auth/index');
   }

   public function loginUser()
   {
      // Validating user input

      $validated = $this->validate([
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Le pseudo complet est requis',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[30]', 'errors' => ['required' => 'Le mot de passe est requis', 'min_length' => 'Le mot de passe doit faire au moins 5 charactères', 'max_length' => 'Le mot de passe ne doit pas dépasser 30 charactères']],
      ]);

      if (!$validated) {
         return view('auth/login', ['validation' => $this->validator]);
      } else {
         // Checking user details in database

         $pseudo = $this->request->getPost('pseudo');
         $password = $this->request->getPost('password');

         $userModel = new UserModel();
         $userInfo = $userModel->where('pseudo', $pseudo)->first();

         if (!$userInfo) {
            session()->setFlashdata('fail', 'Utilisateur introuvable');
            return redirect()->to('auth')->withInput();
         }

         // Check user password with db password
         $checkPassword = Hash::check($password, $userInfo['password']);

         if (!$checkPassword) {
            session()->setFlashdata('fail', 'Mot de passe incorrect');
            return redirect()->to('auth')->withInput();
         } else {
            // Process user info

            print_r($userInfo);

            $userId = $userInfo['id_user'];

            session()->set('loggedInUser', $userId);
            return redirect()->to('dashboard/index')->with('success', 'Connexion réussie');
         }
      }
   }

   public function uploadImage()
   {
      try {
         $loggedInUserId = session()->get('loggedInUser');

         // Obtenir l'image
         $img = $this->request->getFile('userImage');

         if ($loggedInUserId && $img && $img->isValid() && !$img->hasMoved()) {

            $config['upload_path'] = getcwd() . '/assets/avatar';
            $imageName = $img->getName();
            $imageExtension = Extension::getExtension($imageName);

            // Si le répertoire n'est pas présent, le créer
            if (!is_dir($config['upload_path'])) {
               mkdir($config['upload_path'], 0777);
            }

            // Récupérer l'ancien nom de fichier depuis la base de données
            $userModel = new UserModel();
            $oldAvatar = $userModel->find($loggedInUserId)['avatar'];

            $errors = [];

            // Vérifier si le fichier est une image
            if (!Extension::verifyExtension($imageExtension)) {
               return redirect()->to('dashboard')->with('error', 'Format non supporté');
            }

            // Vérifier si le fichier est une image et la taille est inférieure à 2 Mo
            if (!in_array($img->getMimeType(), ['image/jpeg', 'image/png'])) {
               return redirect()->to('dashboard')->with('error', 'Fichier non image');
            }

            if ($img->getSize() > 2097152) {
               return redirect()->to('dashboard')->with('error', 'Fichier supérieur à 2Mo');
            }

            if (empty($errors)) {
               // Supprimer l'ancienne image s'il existe
               if ($oldAvatar && file_exists($config['upload_path'] . '/' . $oldAvatar)) {
                  unlink($config['upload_path'] . '/' . $oldAvatar);
               }

               $imageNewName = time() . rand(0, 999999) . Extension::getExtension($imageName);

               $img->move($config['upload_path'], $imageNewName);

               $data = [
                  'avatar' => $imageNewName,
               ];

               $userModel->update($loggedInUserId, $data);

               return redirect()->to('dashboard')->with('success', 'Image importée');
            }
         } else {
            return redirect()->to('dashboard')->with('error', 'Fichier non supporté');
         }
      } catch (Exception $e) {
         echo $e->getMessage();
      }
   }



   public function logOut()
   {
      if (session()->has('loggedInUser')) {
         session()->remove('loggedInUser');
      }
      return redirect()->to('/auth')->with('error', 'Vous avez été déconnecté');
   }
}

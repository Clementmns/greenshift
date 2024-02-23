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
      echo view('templates/header');
      echo view('auth/login');
      echo view('templates/footer');
   }

   public function register()
   {
      echo view('templates/header');
      echo view('auth/register');
      echo view('templates/footer');
   }

   public function registerUser()
   {

      $validated = $this->validate([
         'firstname' => ['rules' => 'required', 'errors' => ['required' => 'Your full firstname is required',]],
         'lastname' => ['rules' => 'required', 'errors' => ['required' => 'Your full lastname is required',]],
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Your full pseudo is required',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long']],
         'passwordConf' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long', 'matches' => 'Confirm password must match to the password']],
      ]);

      if (!$validated) {
         echo view('templates/header');
         echo view('auth/register', ['validation' => $this->validator]);
         echo view('templates/footer');
      }

      $firstname = $this->request->getPost('firstname');
      $lastname = $this->request->getPost('lastname');
      $pseudo = $this->request->getPost('pseudo');
      $password = $this->request->getPost('password');
      $passwordConf = $this->request->getPost('passwordConf');

      $data = [
         'firstname' => $firstname,
         'lastname' => $lastname,
         'pseudo' => $pseudo,
         'password' => Hash::encrypt($password)
      ];

      // Storing data

      $userModel = new \App\Models\UserModel();
      $query = $userModel->insert($data);
   }

   public function loginUser()
   {
      // Validating user input

      $validated = $this->validate([
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Your full pseudo is required',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long']],
      ]);

      if (!$validated) {
         echo view('templates/header');
         echo view('auth/login', ['validation' => $this->validator]);
         echo view('templates/footer');
      } else {
         // Checking user details in database

         $pseudo = $this->request->getPost('pseudo');
         $password = $this->request->getPost('password');

         $userModel = new UserModel();
         $userInfo = $userModel->where('pseudo', $pseudo)->first();

         if (!$userInfo) {
            session()->setFlashdata('fail', 'User not found');
            return redirect()->to('auth')->withInput();
         }

         // Check user password with db password
         $checkPassword = Hash::check($password, $userInfo['password']);

         if (!$checkPassword) {
            session()->setFlashdata('fail', 'Incorrect password provided');
            return redirect()->to('auth')->withInput();
         } else {
            // Process user info

            print_r($userInfo);

            $userId = $userInfo['id_user'];

            session()->set('loggedInUser', $userId);
            return redirect()->to('/dashboard');
         }
      }
   }

   public function uploadImage()
   {
      try {
         $loggedInUserId = session()->get('loggedInUser');

         $config['upload_path'] = getcwd() . '/assets/avatar';
         $imageName = $this->request->getFile('userImage')->getName();

         // if Directory not present then create

         if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777);
         }

         // Get image

         $img = $this->request->getFile('userImage');

         if (!$img->hasMoved() && $loggedInUserId) {

            $imageNewName = time() . rand(0, 999999) . Extension::getExtension($imageName);

            $img->move($config['upload_path'], $imageNewName);

            $data = [
               'avatar' => $imageNewName,
            ];

            $userModel = new UserModel();
            $userModel->update($loggedInUserId, $data);

            return redirect()->to('dashboard')->with('notification', 'Image uploaded successfully');
         } else {
            return redirect()->to('dashboard')->with('notification', 'Image uploaded failed');
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
      return redirect()->to('/auth?access=loggedout')->with('fail', 'You are logged out');
   }
}

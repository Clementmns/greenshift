<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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

      $validated = $this->validate([
         'firstname' => ['rules' => 'required', 'errors' => ['required' => 'Your full firstname is required',]],
         'lastname' => ['rules' => 'required', 'errors' => ['required' => 'Your full lastname is required',]],
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Your full pseudo is required',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long']],
         'passwordConf' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long', 'matches' => 'Confirm password must match to the password']],
      ]);

      if (!$validated) {
         return view('auth/register', ['validation' => $this->validator]);
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


      if (!$query) {
         return redirect()->back()->with('fail', 'Saving user failed');
      } else {
         return redirect()->back()->with('success', 'Registered successfully');
      }
   }

   public function loginUser()
   {
      // Validating user input

      $validated = $this->validate([
         'pseudo' => ['rules' => 'required', 'errors' => ['required' => 'Your full pseudo is required',]],
         'password' => ['rules' => 'required|min_length[5]|max_length[20]', 'errors' => ['required' => 'Your full password is required', 'min_length' => 'Password must be 5 characters long', 'max_length' => 'Password must be under 20 characters long']],
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
            $img->move($config['upload_path'], $imageName);

            $data = [
               'avatar' => $imageName,
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

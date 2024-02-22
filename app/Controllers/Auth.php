<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UserModel;

class Auth extends BaseController
{
   public function __construct()
   {
      helper(['url', 'form']);
   }

   public function index()
   {
      echo view('auth/login');
   }

   public function register()
   {
      echo view('auth/register');
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
      $passwordConf = $this->request->getPost('password');

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
         return redirect()->back()->with('succes', 'User added successfully');
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

         // Check user password with db password
         $checkPassword = Hash::check($password, $userInfo['password']);

         if (!$checkPassword) {
            session()->setFlashdata('fail', 'Incorrect password provided');
            return redirect()->to('auth');
         } else {
            // Process user info

            $userId = $userInfo['id'];

            session()->set('loggedInUser', $userId);
            return redirect()->to('/dashboard');
         }
      }
   }
}

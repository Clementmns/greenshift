<?php

namespace App\Controllers;

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
      // Validate user input
      // 'firstname' => 'required',
      // 'lastname' => 'required',
      // 'pseudo' => 'required',
      // 'password' => 'required|min_length[5]|max_length[20]',
      // 'passwordConf' => 'required|min_length[5]|max_length[20]|matched[password]',

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
   }
}

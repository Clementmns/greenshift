<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome');
    }

    public function dudule(): string
    {
        return view('page_statique');
    }
}

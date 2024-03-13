<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GoalModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo,
        ];



        return view('dashboard/index', $data);
    }

    public function goals()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $goalModel = new GoalModel();
        $goals = $goalModel->getWeekGoals();

        $data = [
            'title' => 'Goals',
            'userInfo' => $userInfo,
            'goals' => $goals,
        ];

        return view('goals/goalsweek', $data);
    }
}

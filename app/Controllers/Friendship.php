<?php

namespace App\Controllers;

use App\Models\UserModel;

class Friendship extends BaseController
{


    public function index()
    {

        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');

        $userInfo = $userModel->getFriendsRanking($loggedInUserId);
        $test = 12;
        $data = [
            $test,
            $userInfo,
        ];

        return view('classement/friend.php', $data);
    }
}

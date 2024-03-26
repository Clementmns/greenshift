<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BadgeModel;

class UserController extends BaseController
{

   public function getUserInfos()
   {
      $userModel = new UserModel();
      $badgeModel = new BadgeModel();
      $userIdProfile = $this->request->getGet('profileUserId');

      $userData = $userModel->find($userIdProfile);

      $userBadges = $badgeModel->getUserOwnedBadges($userIdProfile);
      $userFavoriteBadges = $userModel->getUserFavoriteBadges($userIdProfile);

      $data = [
         'userData' => $userData,
         'userFavoriteBadges' => $userFavoriteBadges,
         'userBadges' => $userBadges,
      ];

      return view("relation/profile.php", $data);
   }
}

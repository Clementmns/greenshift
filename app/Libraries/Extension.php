<?php


namespace App\Libraries;


class Extension
{

   public static function encrypt($password)
   {
      return password_hash($password, PASSWORD_BCRYPT);
   }
}

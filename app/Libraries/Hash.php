<?php

namespace App\Libraries;

class Hash
{
   // Encrypt user password

   public static function encrypt($password)
   {
      return password_hash($password, PASSWORD_BCRYPT);
   }
}

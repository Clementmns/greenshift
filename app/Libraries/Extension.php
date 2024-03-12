<?php


namespace App\Libraries;


class Extension
{

   public static function getExtension($imageName)
   {
      $pathInfo = pathinfo($imageName);
      return "." . $pathInfo['extension'];
   }

   public static function verifyExtension($extension)
   {
      if ($extension == ".jpg" || $extension == ".jpeg" || $extension == ".png") {
         return true;
      } else {
         return false;
      }
   }
}

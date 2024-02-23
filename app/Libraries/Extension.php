<?php


namespace App\Libraries;


class Extension
{

   public static function getExtension($imageName)
   {
      $pathInfo = pathinfo($imageName);
      return "." . $pathInfo['extension'];
   }
}

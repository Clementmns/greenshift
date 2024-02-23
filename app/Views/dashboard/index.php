<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <div>
      <form action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post">
         <img src="<?= base_url() ?>/assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
         <input type="file" name="userImage">
         <hr>
         <input type="submit">
      </form>
   </div>
   <div>
      <p><?= $userInfo['pseudo']; ?></p>
      <p><?= $userInfo['firstname']; ?></p>
      <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
   </div>

   <?php
   if (!empty(session()->getFlashdata('notification'))) {
   ?>
      <div>
         <?=
         session()->getFlashdata('success');
         ?>
      </div>
   <?php
   }
   ?>
</body>

</html>
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
         <img src="" alt="">
         <input type="file" name="userImage">
         <hr>
         <input type="submit">
      </form>
   </div>
   <div>
      <p><?= $userInfo['pseudo']; ?></p>
      <p><?= $userInfo['']; ?></p>
      <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
   </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/output.css">
</head>

<body>
   <?php if (session()->has('notification')) : ?>
      <div class="alert alert-success"><?= esc(session('notification')) ?></div>
   <?php endif; ?>
   <div>
      <form action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post">
         <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white object-cover" src="<?= base_url() ?>/assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
         <input type="file" name="userImage">
         <hr>
         <br>
         <button class="bg-blue-400 text-white p-2 rounded-md" type="submit">Envoyer</button>
      </form>
   </div>
   <br>
   <div>
      <p><?= $userInfo['pseudo']; ?></p>
      <p><?= $userInfo['firstname']; ?></p>
      <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
   </div>

   <div>
      <?=
      session()->getFlashdata('success');
      ?>
   </div>
</body>

</html>
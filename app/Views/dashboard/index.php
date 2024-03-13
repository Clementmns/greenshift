<?php
echo view("templates/header");
?>


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
<?php
$friends = ["rankingFriend" => $rankingFriend];
echo view("classement/friend", $friends);
?>
<br>
<div>
   <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
</div>

<div>
   <?=
   session()->getFlashdata('success');
   ?>
</div>




<?php
echo view("templates/footer");
?>
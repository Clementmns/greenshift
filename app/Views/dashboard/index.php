<?php
echo view("templates/header");
?>


<?php if (session()->has('notification')) : ?>
   <div class="alert alert-success"><?= esc(session('notification')) ?></div>
<?php endif; ?>
<div>
   <form action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post">
      <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white object-cover" src="<?= base_url() ?>assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
      <input type="file" name="userImage">
      <hr>
      <br>
      <button class="bg-blue-400 text-white p-2 rounded-md" type="submit">Envoyer</button>
   </form>
</div>
<br>
<h2>Classement parmi les amis</h2>
<?php
$friends = ["rankingFriend" => $rankingFriend];
echo view("classement/index", $friends);
?>
<br>
<h2>Classement mondial</h2>
<?php
$world = ["rankingFriend" => $rankingWorld];
echo view("classement/index", $world);
?>
<br>
<?php

echo view("relation/search");
?>
<br>
<?php echo view("goals/goalsweek", $goals); ?>
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
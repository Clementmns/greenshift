<?php
echo view("templates/header");
?>

<div class="w-[calc(100%-240px)]">
   <?php if (session()->has('notification')) : ?>
      <div class="alert alert-success"><?= esc(session('notification')) ?></div>
   <?php endif; ?>

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
   <br>

   <div>
      <?=
      session()->getFlashdata('success');
      ?>
   </div>
</div>



<?php
echo view("templates/footer");
?>
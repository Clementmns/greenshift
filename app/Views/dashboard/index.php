<?php
echo view("templates/header");
echo view("templates/notification");
?>

<div class="box">
   <h2>Classement parmi les amis</h2>
   <?php
   $friends = ["rankingFriend" => $rankingFriend];
   echo view("classement/index", $friends);
   ?>
</div>

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
<div class="box"><?php echo view("goals/goalsweek", $goals); ?></div>

<div>
   <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
</div>
<br>




<?php
echo view("templates/footer");
?>
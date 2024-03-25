<?php
echo view("templates/header");
echo view("templates/notification");
?>


<div class="box"><?php echo view("goals/goalsweek", $goals); ?></div>

<div>
   <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
</div>
<br>




<?php
echo view("templates/footer");
?>
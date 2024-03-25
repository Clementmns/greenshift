<?php
echo view("templates/header");
echo view("templates/notification");
?>


<div class="home box"><?php echo view("goals/goalsweek", $goals); ?></div>
<div class="ranking box"><?php echo view("dashboard/classement"); ?></div>
<div class="badges box"><?php echo view("badges/index"); ?></div>
<div class="shop box"><?php echo view("boutique/index"); ?></div>

<?php
echo view("templates/footer");
?>
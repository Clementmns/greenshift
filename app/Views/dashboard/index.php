<?php
echo view("templates/header");
echo view("templates/notification");
?>


<div class="home box"><?php echo view("goals/goalsweek", $goals); ?></div>
<div class="ranking box hidden"><?php echo view("dashboard/classement"); ?></div>
<div class="badges box hidden"><?php echo view("badges/index"); ?></div>
<div class="shop box hidden"><?php echo view("boutique/index"); ?></div>

<?php
echo view("templates/footer");
?>
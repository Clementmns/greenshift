<?php
echo view("templates/header");
echo view("templates/notification");
?>


<div class="container home box"><?php echo view("goals/goalsweek", $goals); ?></div>
<div class="container ranking box hidden"><?php echo view("dashboard/classement"); ?></div>
<div class="container badges box hidden"><?php echo view("badges/index"); ?></div>
<div class="container shop box hidden"><?php echo view("boutique/index"); ?></div>

<?php
echo view("templates/footer");
?>
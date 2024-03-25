<?php
echo view("templates/header");
echo view("templates/notification");
?>


<div class="box"><?php echo view("goals/goalsweek", $goals); ?></div>

<?php
echo view("templates/footer");
?>
<?php
echo view("templates/header");
?>
<h2>Your Goals for This Week:</h2>
<ul>
   <?php foreach ($goals as $goal) : ?>
      <li>
         <?= esc($goal['title']) ?> - <?= esc($goal['description']) ?>
      </li>
   <?php endforeach; ?>
</ul>

<?php
echo view("templates/footer");
?>
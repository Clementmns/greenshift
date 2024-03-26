<?php
echo view("templates/header");
echo view("templates/notification");
?>
<div class="container home box"><?php echo view("goals/goalsweek", $goals); ?></div>
<div class="container ranking box hidden"><?php echo view("dashboard/classement"); ?></div>
<div class="container badges box hidden"><?php echo view("badges/index"); ?></div>
<div class="container shop box hidden"><?php echo view("boutique/index"); ?></div>
<?php if ($userInfo['role'] == 1) {
   echo '<div class="container admin box flex flex-col gap-4 hidden">';
   echo view("admin/index");
   echo '</div>';
} ?>

<script>
   $(document).ready(function() {
      setTimeout(() => {
         $('.wrapper').fadeIn(200);
      }, 300);
      // Gestion de la navigation
      $('.icon-button').click(function() {
         var page = $(this).attr('data-icon');
         localStorage.setItem('lastVisitedPage', page);
      });

      // Chargement de la dernière page visitée
      var lastVisitedPage = localStorage.getItem('lastVisitedPage');
      if (lastVisitedPage) {
         $('.container').hide();
         $('.' + lastVisitedPage).show();
      }
   });
</script>
<?php
echo view("templates/footer");
?>
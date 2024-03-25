<?php
echo view("templates/header");
echo view("templates/notification");
$lastVisitedPage = isset($_COOKIE['last_visited_page']) ? $_COOKIE['last_visited_page'] : 'home';
?>
<div class="container home box" <?php if ($lastVisitedPage == 'home') echo 'style="display: block;"'; ?>><?php echo view("goals/goalsweek", $goals); ?></div>
<div class="container ranking box" <?php if ($lastVisitedPage == 'ranking') echo 'style="display: block;"'; ?>><?php echo view("dashboard/classement"); ?></div>
<div class="container badges box" <?php if ($lastVisitedPage == 'badges') echo 'style="display: block;"'; ?>><?php echo view("badges/index"); ?></div>
<div class="container shop box" <?php if ($lastVisitedPage == 'shop') echo 'style="display: block;"'; ?>><?php echo view("boutique/index"); ?></div>
<div class="container admin box flex flex-col gap-4" <?php if ($lastVisitedPage == 'admin') echo 'style="display: block;"'; ?>><?php echo view("admin/index"); ?></div>
<?php
echo view("templates/footer");
?>

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
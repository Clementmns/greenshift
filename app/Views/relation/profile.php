<div class="flex items-center flex-col">
   <div class="flex flex-col items-center gap-2">
      <img class="inline-block h-24 w-24 rounded-full object-cover" src="<?= base_url() ?>assets/avatar/<?= $userData['avatar']; ?>" alt="">
      <p class="font-semibold text-lg"><?= $userData['pseudo']; ?></p>
      <p class="text-gray-400">Niv. <?= $userData['level'] ?></p>
      <div class="wrapper-progress-bar opacity-100 transition-opacity">
         <div class="container-progress-bar-level<?= $userData['id_user'] ?> h-2 rounded-full w-52 bg-gray-200 relative">
            <div class="progress-bar-level<?= $userData['id_user'] ?> absolute h-full bg-primary-500 rounded-full"></div>
         </div>
      </div>
      <?php if (isset($userFavoriteBadges['link'])) : ?>
         <div class="flex flex-col items-center mt-10">
            <img class="inline-block h-56 rounded-md object-cover" src="<?= base_url() ?>assets/badges/<?= $userFavoriteBadges['link']; ?>" alt="">
         </div>
      <?php endif; ?>
   </div>
</div>

<script>
   // Calcul de la largeur de la barre de progression
   $(document).ready(function() {

      function calculateProgress(exp, level) {
         let expGoal = level * 200 + 400;
         let progress = exp * 100 / expGoal;
         return progress;
      }

      // Calcul de la largeur de la barre de progression pour cet utilisateur
      let progressWidthLevel<?= $userData['id_user'] ?> = calculateProgress(<?= $userData['exp'] ?>, <?= $userData['level'] ?>);

      // Appliquer la largeur calculée à la barre de progression
      $('.progress-bar-level<?= $userData['id_user'] ?>').css("width", progressWidthLevel<?= $userData['id_user'] ?> + "%");

   });
</script>
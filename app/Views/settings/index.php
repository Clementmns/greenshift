<div class=" flex flex-col justify-between text-xl w-[70vw] landscape:w-[20vw] shadow-classic h-full rounded-r-lg rounded-b-lg  bg-white p-4">
   <img class="menuClosePopup cursor-pointer inline-block h-8 w-8 self-end" src="<?= base_url() ?>assets/icons/cross.svg" alt="">
   <div class="h-[80%]">
      <div class="flex items-center flex-col">
         <div class="flex flex-col items-center gap-2 h-[full]">
            <div id="avatarContainer" class="relative cursor-pointer inline-block">
               <img class="inline-block h-28 opacity-100 w-28 rounded-full ring-2 ring-white object-cover" src="<?= base_url() ?>assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
               <div class="w-12 h-12 bg-gray-200 shadow-classic rounded-full absolute right-[-5px] bottom-[-5px] flex justify-center items-center">

                  <svg id="avatarImage" class="h-6 w-6 fill-gray-500 stroke-3" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
                     <path d="M22.853,1.148a3.626,3.626,0,0,0-5.124,0L1.465,17.412A4.968,4.968,0,0,0,0,20.947V23a1,1,0,0,0,1,1H3.053a4.966,4.966,0,0,0,3.535-1.464L22.853,6.271A3.626,3.626,0,0,0,22.853,1.148ZM5.174,21.122A3.022,3.022,0,0,1,3.053,22H2V20.947a2.98,2.98,0,0,1,.879-2.121L15.222,6.483l2.3,2.3ZM21.438,4.857,18.932,7.364l-2.3-2.295,2.507-2.507a1.623,1.623,0,1,1,2.295,2.3Z" />
                  </svg>

               </div>
            </div>
            <p class="font-semibold text-lg"><?= $userInfo['pseudo']; ?></p>
            <p class="text-gray-400">Niv. <?= $userInfo['level'] ?></p>
            <div class="wrapper-progress-bar opacity-100 transition-opacity">
               <div class="container-progress-bar-level h-2 rounded-full w-52 bg-gray-200 relative">
                  <div class="progress-bar-level-user absolute h-full bg-primary-500 rounded-full"></div>
               </div>
            </div>
            <?php if (isset($userFavoriteBadges['link'])) : ?>
               <h2 class="mt-4">Mon badge favori :</h2>
               <div class="flex flex-col items-center mt-1">
                  <img class="inline-block w-44 rounded-md object-cover" src="<?= base_url() ?>assets/badges/<?= $userFavoriteBadges['link']; ?>" alt="">
               </div>
            <?php endif; ?>
         </div>
      </div>


   </div>
   <div class="flex flex-col items-center w-full gap-1">

      <a class="w-full text-center text-white rounded-lg bg-red-500 landscape:hover:bg-red-700 transition-all py-2" href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
      <p class="text-xs text-gray-400">GreenShift© - 2024</p>
   </div>
</div>

<!-- Formulaire masqué pour envoyer l'image -->
<form id="imageForm" action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post" style="display: none;">
   <input id="userImageInput" type="file" name="userImage">
   <button class="bg-primary-500 text-white p-2 rounded-md" type="submit">Envoyer</button>
</form>

<script>
   // Calcul de la largeur de la barre de progression
   $(document).ready(function() {

      // Lorsque l'utilisateur clique sur l'image, le clic sur le champ de fichier est déclenché
      $("#avatarImage").click(function() {
         $("#userImageInput").click();
      });

      // Lorsque l'utilisateur sélectionne une image, le formulaire est soumis automatiquement
      $("#userImageInput").change(function() {
         $("#imageForm").submit();
      });

      function calculateProgress(exp, level) {
         let expGoal = level * 200 + 400;
         let progress = exp * 100 / expGoal;
         return progress;
      }

      // Calcul de la largeur de la barre de progression pour cet utilisateur
      let progressWidthLevelUser = calculateProgress(<?= $userInfo['exp'] ?>, <?= $userInfo['level'] ?>);

      // Appliquer la largeur calculée à la barre de progression
      $('.progress-bar-level-user').css("width", progressWidthLevelUser + "%");

   });
</script>
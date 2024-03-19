<div id="userInfoMenu" class="w-20 right-0 top-0 overflow-hidden transition-all h-screen fixed bg-gray-100">
   <!-- Infos de l'utilisateur -->
   <div class="flex justify-center items-center flex-col p-2">
      <div class="flex items-center flex-col relative">
         <!-- Conteneur de l'image de profil et du texte -->
         <div id="avatarContainer" class="relative cursor-pointer inline-block">
            <!-- Image de profil avec id pour faciliter la sélection -->
            <img id="editText" class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-10" src="<?= base_url() ?>assets/img/pen.png" />
            <img id="avatarImage" class="inline-block h-16 opacity-100 w-16 rounded-full ring-2 ring-white object-cover transition-opacity hover:opacity-50" src="<?= base_url() ?>assets/avatar/<?= $userInfo['avatar']; ?>" alt="">

         </div>
         <h2 class="font-bold mb-3"><?= $userInfo['pseudo'] ?></h2>
         <h3 class="">Niveau <?= $userInfo['level'] ?></h3>
      </div>
      <div class="wrapper-progress-bar opacity-0 transition-opacity">
         <div class="container-progress-bar h-2 rounded-full w-52 bg-gray-200 relative">
            <div class="progress-bar absolute h-full bg-primary-500 rounded-full"></div>
         </div>
      </div>
   </div>
</div>

<!-- Formulaire masqué pour envoyer l'image -->
<form id="imageForm" action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post" style="display: none;">
   <input id="userImageInput" type="file" name="userImage">
   <button class="bg-primary-500 text-white p-2 rounded-md" type="submit">Envoyer</button>
</form>




<script>
   $(document).ready(function() {
      // Au survol de la souris, changez la largeur du menu
      $("#userInfoMenu").hover(
         function() {
            $(this).removeClass("w-20").addClass("w-60");
            $('.wrapper-progress-bar').css('opacity', '100%')
         },
         function() {
            $(this).removeClass("w-60").addClass("w-20");
            $('.wrapper-progress-bar').css('opacity', '0%')
         }
      );

      // Lorsque l'utilisateur clique sur l'image, le clic sur le champ de fichier est déclenché
      $("#avatarImage").click(function() {
         $("#userImageInput").click();
      });

      // Lorsque l'utilisateur sélectionne une image, le formulaire est soumis automatiquement
      $("#userImageInput").change(function() {
         $("#imageForm").submit();
      });

      // Calcul de la largeur de la barre de progression
      function calculateProgress(exp, level) {
         let expGoal = level * 200 + 400;
         progress = exp * 100 / expGoal;
         return progress;
      }

      let progressWidth = calculateProgress(<?= $userInfo['exp'] ?>, <?= $userInfo['level'] ?>);
      $('.progress-bar').css("width", progressWidth + "%");
   });
</script>
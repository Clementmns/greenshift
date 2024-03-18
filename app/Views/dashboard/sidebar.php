<div class="absolute w-60 right-0 top-0">
   <!-- Infos de l'utilisateur -->
   <div class="flex justify-center items-center flex-col p-2">
      <div class="flex items-center flex-col">
         <!-- Image de profil avec id pour faciliter la sélection -->
         <img id="avatarImage" class="cursor-pointer inline-block h-16 w-16 rounded-full ring-2 ring-white object-cover hover:opacity-60 transition-all" src="<?= base_url() ?>assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
         <h2 class="font-bold mb-3"><?= $userInfo['pseudo'] ?></h2>
         <h3 class="">Niveau <?= $userInfo['level'] ?></h3>
      </div>
      <div>
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
      progress = exp * 100 / expGoal;

      return progress;
   }

   let progressWidth = calculateProgress(<?= $userInfo['exp'] ?>, <?= $userInfo['level'] ?>);
   $('.progress-bar').css("width", progressWidth + "%");
</script>
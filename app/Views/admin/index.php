<div class="landscape:flex justify-center gap-4">
   <div class="box w-full">
      <h1 class="add-badges font-semibold text-center mb-4 text-lg text-primary-500 underline">Ajouter un badge dans la boutique</h1>
      <div class="add-badges-container hidden landscape:block">
         <form id="add-badge-form" action="<?= site_url('BadgeController/addBadge') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-10">
               <div class="mb-4">
                  <label for="titre" class="block text-sm font-medium">Titre :</label>
                  <input type="text" id="titre" name="titre" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" placeholder="Titre du badge" required>
               </div>
               <div class="mb-4">
                  <label for="prix" class="block text-sm font-medium">Prix :</label>
                  <input type="number" id="prix" name="prix" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" min="400" max="1600" step="100" value="400" required>
               </div>
               <div class="mb-4">
                  <label for="image" class="block text-sm font-medium">Image :</label>
                  <input type="file" id="image" name="image" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" accept="image/*" required>
               </div>
            </div>
            <button type="submit" class="w-full bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg landscape:hover:bg-primary-700 transition-all">Ajouter</button>
         </form>
      </div>
   </div>

   <script>
      $(document).ready(function() {
         $('#add-badge-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
               url: $(this).attr('action'),
               type: 'post',
               data: formData,
               contentType: false,
               processData: false,
               success: function(response) {
                  // Gérer la réponse en cas de succès
                  $('#add-badge-form')[0].reset();
                  location.reload();
                  // Afficher un message de succès ou rediriger l'utilisateur
               },
               error: function(xhr, status, error) {
                  // Gérer les erreurs
                  console.error(xhr.responseText);
                  // Afficher un message d'erreur à l'utilisateur
               }
            });
         });
      });
   </script>
   <?php if (!isset($goalsNextWeek[0])) : ?>
      <div class="box mt-4 w-full landscape:mt-0">
         <h1 class="goals-week font-semibold text-center mb-4 text-lg text-primary-500 underline">Ajouter les objectifs de la semaine prochaine (semaine <?= date('W') + 1 ?>)</h1>
         <div class="goals-week-container hidden landscape:block">
            <form id="add-goals-form" action="<?= site_url('GoalController/addGoals') ?>" method="post">
               <?= csrf_field() ?>
               <?php for ($i = 1; $i <= 5; $i++) : ?>
                  <div class="mb-10">
                     <h2 class="text-md font-semibold mb-2">Objectif <?= $i ?></h2>
                     <div class="mb-4">
                        <label for="titre<?= $i ?>" class="block text-sm font-medium">Titre :</label>
                        <input type="text" id="titre<?= $i ?>" name="titre<?= $i ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" placeholder="Titre de l'objectif <?= $i ?>" required>
                     </div>
                     <div class="mb-4">
                        <label for="description<?= $i ?>" class="block text-sm font-medium">Description :</label>
                        <textarea id="description<?= $i ?>" name="description<?= $i ?>" rows="3" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" placeholder="Description de l'objectif <?= $i ?>" required></textarea>
                     </div>
                     <div class="mb-4">
                        <label for="prix<?= $i ?>" class="block text-sm font-medium">Récompense :</label>
                        <input type="number" id="prix<?= $i ?>" name="prix<?= $i ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" min="400" max="1600" step="100" value="400" required>
                     </div>
                  </div>
               <?php endfor; ?>
               <button type="submit" class="w-full bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg landscape:hover:bg-primary-700 transition-all">Ajouter</button>
            </form>
         </div>
      </div>

      <script>
         $(document).ready(function() {
            $('#add-goals-form').submit(function(e) {
               e.preventDefault();
               var formData = $(this).serialize();
               $.ajax({
                  url: $(this).attr('action'),
                  type: 'post',
                  data: formData,
                  success: function(response) {
                     // Gérer la réponse en cas de succès
                     $('#add-goals-form')[0].reset();
                     location.reload();
                     // Afficher un message de succès ou rediriger l'utilisateur
                  },
                  error: function(xhr, status, error) {
                     // Gérer les erreurs
                     console.error(xhr.responseText);
                     // Afficher un message d'erreur à l'utilisateur
                  }
               });
            });
         });
      </script>
</div>



<?php endif; ?>

<script>
   $('.goals-week').on('click', () => {
      $('.goals-week-container').slideToggle(200);
   })

   $('.add-badges').on('click', () => {
      $('.add-badges-container').slideToggle(200);
   })
</script>
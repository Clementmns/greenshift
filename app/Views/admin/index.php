<div class="box">
   <h1 class="goals-week font-semibold text-center mb-4 text-lg text-primary-500 underline">Ajouter les objectifs de la semaine prochaine (semaine <?= date('W') + 1 ?>)</h1>
   <div class="goals-week-container hidden">
      <form action="" method="post" class=" p-2">
         <?php for ($i = 1; $i <= 5; $i++) : ?>
            <div class="mb-10">
               <h2 class="text-md font-semibold mb-2">Badge <?= $i ?></h2>
               <div class="mb-4">
                  <label for="titre<?= $i ?>" class="block text-sm font-medium">Titre :</label>
                  <input type="text" id="titre<?= $i ?>" name="titre<?= $i ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" placeholder="Titre du badge <?= $i ?>" required>
               </div>
               <div class="mb-4">
                  <label for="description<?= $i ?>" class="block text-sm font-medium">Description :</label>
                  <textarea id="description<?= $i ?>" name="description<?= $i ?>" rows="3" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" placeholder="Description du badge <?= $i ?>" required></textarea>

               </div>
               <div class="mb-4">
                  <label for="prix<?= $i ?>" class="block text-sm font-medium">Récompense :</label>
                  <input type="number" id="prix<?= $i ?>" name="prix<?= $i ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" min="400" max="1600" step="100" value="400" required>
               </div>
            </div>
         <?php endfor; ?>
         <button type="submit" class="w-full bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg">Ajouter</button>
      </form>
   </div>
</div>
<div class="box">
   <h1 class="add-badges font-semibold text-center mb-4 text-lg text-primary-500 underline">Ajouter un badge dans la boutique</h1>
   <div class="add-badges-container hidden">
      <form action="" method="post" class="p-2" enctype="multipart/form-data">
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
         <button type="submit" class="w-full bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg">Ajouter</button>
      </form>
   </div>
</div>


<script>
   $('.goals-week').on('click', () => {
      $('.goals-week-container').toggle(200);
   })

   $('.add-badges').on('click', () => {
      $('.add-badges-container').toggle(200);
   })
</script>
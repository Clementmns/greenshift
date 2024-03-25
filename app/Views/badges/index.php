<?php echo view("templates/header"); ?>

<div class="mx-4 my-8 space-y-4">

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Vos badges :</h1>
        <ul class="space-y-2">
            <?php foreach ($userBadges as $badge): ?>
                <li class="flex items-center">
                    <span class="ml-2"><?php echo $badge['title']; ?></span>
                    <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>" class="w-8 h-8 ml-2">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Ajouter des badges aux favoris :</h1>
        <form action="<?php echo base_url('boutique/addFavoriteBadges'); ?>" method="post">
            <select name="favorite_badges[]" multiple>
                <?php foreach ($userBadges as $badge): ?>
                    <option value="<?php echo $badge['id_badge']; ?>"><?php echo $badge['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Ajouter aux favoris</button>
        </form>
    </div>

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Badges favoris :</h1>
        <ul class="space-y-2">
            <?php foreach ($userFavoriteBadges as $favoriteBadge): ?>
                <li class="flex items-center">
                    <span class="ml-2"><?php echo $favoriteBadge['title']; ?></span>
                    <img src="<?php echo $favoriteBadge['link']; ?>" alt="<?php echo $favoriteBadge['title']; ?>" class="w-8 h-8 ml-2">
                    <a href="<?php echo base_url('boutique/removeFavoriteBadge/'.$favoriteBadge['id_badge']); ?>" class="text-red-500 hover:text-red-700 ml-auto">Supprimer des favoris</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<?php echo view("templates/footer"); ?>

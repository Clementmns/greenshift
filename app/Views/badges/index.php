<?php echo view("templates/header"); ?>

<div class="mx-4 my-8 grid gap-8">

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Vos badges :</h1>
        <form action="<?php echo base_url('boutique/addFavoriteBadges'); ?>" method="post" class="text-right">
            <div class="grid grid-cols-3 gap-4">
                <?php foreach ($userBadges as $badge): ?>
                    <div class="flex flex-col items-center">
                        <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>" class="w-20 h-20 mb-2">
                        <span class="font-semibold"><?php echo $badge['title']; ?></span>
                        <?php if (count($userFavoriteBadges) < 3): ?>
                            <input type="checkbox" name="favorite_badges[]" value="<?php echo $badge['id_badge']; ?>" class="mt-2">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($userFavoriteBadges) < 3): ?>
                <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-700 mt-4">Ajouter aux favoris</button>
            <?php else: ?>
                <p>Vous ne pouvez avoir que trois Badges en favoris simultanément</p>
            <?php endif; ?>
        </form>
    </div>

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Badges favoris :</h1>
        <form action="<?php echo base_url('boutique/removeFavoriteBadges'); ?>" method="post" class="text-right">
            <div class="grid grid-cols-3 gap-4">
                <?php foreach ($userFavoriteBadges as $favoriteBadge): ?>
                    <div class="flex flex-col items-center">
                        <img src="<?php echo $favoriteBadge['link']; ?>" alt="<?php echo $favoriteBadge['title']; ?>" class="w-20 h-20 mb-2">
                        <span class="font-semibold"><?php echo $favoriteBadge['title']; ?></span>
                        <input type="checkbox" name="favorite_badges_to_remove[]" value="<?php echo $favoriteBadge['id_badge']; ?>" class="mt-2">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($userFavoriteBadges)): ?>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 mt-4">Supprimer</button>
            <?php endif; ?>
        </form>
    </div>

</div>

<?php echo view("templates/footer"); ?>

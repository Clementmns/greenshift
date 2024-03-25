<?php echo view("templates/header"); ?>

<div class="mx-4 my-8 grid gap-8">

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Tous les badges disponibles :</h1>
        <div class="grid grid-cols-3 gap-4">
            <?php $count = 0; ?>
            <?php foreach ($allBadges as $badge): ?>
                <div class="flex flex-col items-center">
                    <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>" class="w-20 h-20 mb-2">
                    <span class="font-semibold"><?php echo $badge['title']; ?></span>
                    <?php if ($badge['price'] > 0): ?>
                        <div class="rounded-md bg-secondary-500 flex items-center p-[2px] pl-1 pr-1 gap-2 mt-2">
                            <img class="inline-block h-4 !w-4" src="<?= base_url() ?>assets/icons/shifter.svg" alt="">
                            <p class="font-semibold text-sm"><?php echo $badge['price']; ?></p>
                        </div>
                        <a href="<?php echo base_url('boutique/buyBadge/'.$badge['id_badge']); ?>" class="text-blue-500 hover:text-blue-700 mt-2">Acheter</a>
                    <?php endif; ?>
                </div>
                <?php $count++; ?>
                <?php if ($count % 3 == 0): ?>
                    </div><div class="grid grid-cols-3 gap-4">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Vos badges :</h1>
        <div class="grid grid-cols-3 gap-4">
            <?php foreach ($userBadges as $badge): ?>
                <div class="flex flex-col items-center">
                    <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>" class="w-20 h-20 mb-2">
                    <span class="font-semibold"><?php echo $badge['title']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
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
        <div class="grid grid-cols-3 gap-4">
            <?php foreach ($userFavoriteBadges as $favoriteBadge): ?>
                <div class="flex flex-col items-center">
                    <img src="<?php echo $favoriteBadge['link']; ?>" alt="<?php echo $favoriteBadge['title']; ?>" class="w-20 h-20 mb-2">
                    <span class="font-semibold"><?php echo $favoriteBadge['title']; ?></span>
                    <a href="<?php echo base_url('boutique/removeFavoriteBadge/'.$favoriteBadge['id_badge']); ?>" class="text-red-500 hover:text-red-700">Supprimer des favoris</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php echo view("templates/footer"); ?>

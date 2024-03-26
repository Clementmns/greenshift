<div class="flex flex-col items-center gap-4">
    <div class="box flex items-center flex-col">
        <h1 class="text-xl font-bold mb-4">Badge favori :</h1>
        <?php if (isset($userFavoriteBadges['link'])) : ?>
            <form action="<?php echo base_url('boutique/removeFavoriteBadges'); ?>" method="post" class="text-right">
                <div class="flex flex-col items-center">
                    <img src="<?php echo ('assets/badges/' . $userFavoriteBadges['link']); ?>" alt="<?php echo $userFavoriteBadges['title']; ?>" class="w-full mb-2 object-cover rounded-md">
                    <p class="font-semibold text-center"><?php echo $userFavoriteBadges['title']; ?></p>
                </div>
            </form>
        <?php else : ?>
            <div>
                <h3>Vous n'avez pas défini de badge favori</h3>
            </div>
        <?php endif; ?>
    </div>
    <div class="box w-full">
        <h1 class="text-xl font-bold mb-4">Vos badges :</h1>
        <?php if (isset($userBadges)) : ?>
            <form action="<?php echo base_url('boutique/addFavoriteBadges'); ?>" method="post" class="text-right">
                <div class="flex items-center justify-center gap-4 flex-wrap">

                    <?php foreach ($userBadges as $badge) : ?>
                        <div class="flex flex-col items-center justify-center">

                            <label for="favorite_badges[<?= $badge['id_badge']; ?>]">
                                <img src="<?php echo ('assets/badges/' . $badge['link']); ?>" alt="<?php echo $badge['title']; ?>" class="w-20 h-20 mb-2 object-cover rounded-md">
                                <p class="font-semibold text-center"><?php echo $badge['title']; ?></p>
                            </label>
                            <input id="favorite_badges[<?= $badge['id_badge']; ?>]" type="radio" name="favorite_badges" value="<?php echo $badge['id_badge']; ?>" class="mt-2">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (isset($userFavoriteBadges)) : ?>
                    <button type="submit" class="w-full bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-700 mt-4">Remplacer</button>
                <?php else : ?>
                    <button type="submit" class="w-full bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-700 mt-4">Définir en tant que favori</button>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <div>
                <h3>Vous n'avez pas encore de badge</h3>
            </div>
        <?php endif; ?>
    </div>
</div>
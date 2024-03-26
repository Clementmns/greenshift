<div class="mx-4 my-8 grid gap-8">

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Tous les badges disponibles :</h1>
        <div class="flex items-center gap-4 flex-wrap">
            <?php foreach ($allBadges as $badge) : ?>
                <div class="flex flex-col items-center justify-center">
                    <img src="<?php echo ('assets/badges/' . $badge['link']); ?>" alt="<?php echo $badge['title']; ?>" class="w-20 mb-2 object-cover rounded-md">
                    <span class="font-semibold"><?php echo $badge['title']; ?></span>
                    <div class="rounded-md bg-secondary-500 flex items-center p-[2px] pl-1 pr-1 gap-2 mt-2">
                        <img class="inline-block h-4 !w-4" src="<?= base_url() ?>assets/icons/shifter.svg" alt="">
                        <p class="font-semibold text-sm"><?php echo $badge['price']; ?></p>
                    </div>
                    <a href="<?php echo base_url('boutique/buyBadge/' . $badge['id_badge']); ?>" class="text-white bg-primary-500 p-1 rounded-md  mt-2">Acheter</a>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>
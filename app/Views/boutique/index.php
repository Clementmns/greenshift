<?php echo view("templates/header"); ?>

<div class="mx-4 my-8 grid gap-8">

    <div class="box">
        <h1 class="text-xl font-bold mb-4">Tous les badges disponibles :</h1>
        <form action="<?php echo base_url('boutique/buyBadges'); ?>" method="post" class="text-right">
            <div class="grid grid-cols-3 gap-4">
                <?php foreach ($allBadges as $badge): ?>
                    <div class="flex flex-col items-center">
                        <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>" class="w-20 h-20 mb-2">
                        <span class="font-semibold"><?php echo $badge['title']; ?></span>
                        <input type="checkbox" name="selected_badges[]" value="<?php echo $badge['id_badge']; ?>" class="mt-2">
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-700 mt-4">Acheter </button>
        </form>
    </div>

</div>

<?php echo view("templates/footer"); ?>

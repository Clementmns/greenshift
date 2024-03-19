<?php echo view("templates/header"); ?>

<h1>Tous les badges disponibles :</h1>
<ul>
    <?php foreach ($allBadges as $badge): ?>
        <li class="flex">
            <?php echo $badge['title']; ?> - <?php echo $badge['price']; ?> points
            <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>">
            <a href="<?php echo base_url('boutique/buyBadge/'.$badge['id_badge']); ?>">Acheter</a>
        </li>
    <?php endforeach; ?>
</ul>

<h1>Vos badges :</h1>
<ul>
    <?php foreach ($userBadges as $badge): ?>
        <li class="flex">
            <?php echo $badge['title']; ?> - <?php echo $badge['price']; ?> points
            <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>">
        </li>
    <?php endforeach; ?>
</ul>

<h1>Ajouter des badges aux favoris :</h1>
<form action="<?php echo base_url('boutique/addFavoriteBadges'); ?>" method="post">
    <select name="favorite_badges[]" multiple>
        <?php foreach ($userBadges as $badge): ?>
            <option value="<?php echo $badge['id_badge']; ?>"><?php echo $badge['title']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Ajouter aux favoris</button>
</form>

<h1>Badges favoris :</h1>
<ul>
    <?php foreach ($userFavoriteBadges as $favoriteBadge): ?>
        <li class="flex">
            <?php echo $favoriteBadge['title']; ?> - <?php echo $favoriteBadge['price']; ?> points
            <img src="<?php echo $favoriteBadge['link']; ?>" alt="<?php echo $favoriteBadge['title']; ?>">
        </li>
    <?php endforeach; ?>
</ul>

<?php echo view("templates/footer"); ?>

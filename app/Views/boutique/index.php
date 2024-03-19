<!-- app/Views/boutique/index.php -->
<?php echo view("templates/header"); ?>
<h1>Tous les badges disponibles :</h1>
<ul>
    <?php foreach ($allBadges as $badge): ?>
        <li>
            <?php echo $badge['title']; ?> - <?php echo $badge['price']; ?> points
            <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>">
            <a href="<?php echo base_url('boutique/buyBadge/'.$badge['id_badge']); ?>">Acheter</a>
        </li>
    <?php endforeach; ?>
</ul>

<h1>Vos badges :</h1>
<ul>
    <?php foreach ($userBadges as $badge): ?>
        <li>
            <?php echo $badge['title']; ?> - <?php echo $badge['price']; ?> points
            <img src="<?php echo $badge['link']; ?>" alt="<?php echo $badge['title']; ?>">
        </li>
    <?php endforeach; ?>
</ul>
<?php echo view("templates/footer"); ?>

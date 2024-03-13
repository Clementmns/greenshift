<?php
echo view("templates/header");
?>
<h1>Classement de mes amis</h1>

<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rankingFriend as $friend) : ?>
            <?php if ($friend['id_user'] == $id_user) { ?>
                <tr class="bg-primary">
                    <td><img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="<?= base_url() ?>/assets/avatar/<?= $friend['avatar']; ?>" alt=""></td>
                    <td><?= $friend['pseudo'] ?></td>
                    <td><?= $friend['firstname'] ?></td>
                    <td><?= $friend['lastname'] ?></td>
                    <td><?= $friend['points'] ?></td>
                </tr>
            <?php } else {
            ?>
                <tr>
                    <td><img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="<?= base_url() ?>/assets/avatar/<?= $friend['avatar']; ?>" alt=""></td>
                    <td><?= $friend['pseudo'] ?></td>
                    <td><?= $friend['firstname'] ?></td>
                    <td><?= $friend['lastname'] ?></td>
                    <td><?= $friend['points'] ?></td>
                </tr>
        <?php }
        endforeach; ?>
    </tbody>
</table>

<br>
<div>
    <a href="<?= site_url('auth/logOut'); ?>">Déconnexion</a>
</div>

<div>
    <?=
    session()->getFlashdata('success');
    ?>
</div>




<?php
echo view("templates/footer");
?>
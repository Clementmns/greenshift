<h1>Classement de mes amis</h1>
<?= $data ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Nombre de réalisations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($friends_ranking as $friend) : ?>
            <tr>
                <td><?= $friend['id_user'] ?></td>
                <td><?= $friend['firstname'] ?></td>
                <td><?= $friend['lastname'] ?></td>
                <td><?= $friend['total'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
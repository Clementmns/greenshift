<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Classement de mes amis</h1>

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
</body>
</html>

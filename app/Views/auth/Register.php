<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Inscription</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <form action="<?= base_url('auth/registerUser') ?>" method="post">
        <?= csrf_field(); ?>
        <div>
            <label for="prenom">Prénom</label>
            <input id="prenom" type="text" name="prenom" placeholder="Prénom here">
        </div>
        <div>
            <label for="name">Nom</label>
            <input id="name" type="text" name="name" placeholder="Nom de famille here">
        </div>
        <div>
            <label for="pseudo">Pseudo</label>
            <input id="pseudo" type="text" name="pseudo" placeholder="Pseudo here">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password here">
        </div>
        <div>
            <label for="passwordConf">Confirm Password</label>
            <input id="passwordConf" type="password" name="passwordConf" placeholder="Confirm Password here">
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
    <br>
    <a href="<?= base_url('auth'); ?>">Vous avez déjà un compte ? Se connecter</a>
</body>

</html>
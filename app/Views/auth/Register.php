<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Inscription</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <form action="" method="post">
        <?=csrf_field();?>
        <div>
            <label for="">Prénom</label>
            <input type="text" name="prenom" placeholder="Prénom here">
        </div>
        <div>
            <label for="">Nom</label>
            <input type="text" name="name" placeholder="Nom de famille here">
        </div>
        <div>
            <label for="">Pseudo</label>
            <input type="text" name="pseudo" placeholder="Pseudo here">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password here">
        </div>
        <div>
            <label for="">Confirm Password</label>
            <input type="password" name="passwordConf" placeholder="Confirm Password here">
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
    <br>
    <a href="<?= site_url('auth'); ?>">Vous avez déjà un compte ? Se connecter</a>
</body>

</html>
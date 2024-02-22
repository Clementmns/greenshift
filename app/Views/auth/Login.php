<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Connexion</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <form action="" method="post">
        <?=csrf_field();?>
        <div>
            <label for="">Pseudo</label>
            <input type="text" name="pseudo" placeholder="Pseudo here">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password here">
        </div>
        <div>
            <input type="submit" value="Sign In">
        </div>
    </form>
    <a href="<?= site_url('public/register'); ?>">Créer un compte</a>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Connexion</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <form action="<?= base_url('auth/loginUser') ?>" method="post">
        <?= csrf_field(); ?>
        <div>
            <label for="pseudo">Pseudo</label>
            <input value="<?= set_value('pseudo'); ?>" id="pseudo" type="text" name="pseudo" placeholder="Pseudo here">
            <span><?= isset($validation) ? display_form_errors($validation, 'pseudo') : ''; ?></span>
        </div>
        <div>
            <label for="password">Password</label>
            <input value="<?= set_value('password'); ?>" id="password" type="password" name="password" placeholder="Password here">
            <span><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></span>

        </div>
        <div>
            <input type="submit" value="Sign In">
        </div>
    </form>
</body>

</html>
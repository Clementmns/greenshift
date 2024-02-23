<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Inscription</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/output.css">
</head>

<body>
    <form action="<?= base_url('auth/registerUser') ?>" method="post">
        <?= csrf_field(); ?>
        <div>
            <label for="firstname">Prénom</label>
            <input value="<?= set_value('firstname'); ?>" id="firstname" type="text" name="firstname" placeholder="Prénom here">
            <span><?= isset($validation) ? display_form_errors($validation, 'firstname') : ''; ?></span>

        </div>
        <div>
            <label for="lastname">Nom</label>
            <input value="<?= set_value('lastname'); ?>" id="lastname" type="text" name="lastname" placeholder="Nom de famille here">
            <span><?= isset($validation) ? display_form_errors($validation, 'lastname') : ''; ?></span>

        </div>
        <div>
            <label for="pseudo">Pseudo</label>
            <input value="<?= set_value('pseudo'); ?>" id="pseudo" type="text" name="pseudo" placeholder="Pseudo here">
            <span><?= isset($validation) ? display_form_errors($validation, 'pseudo') : ''; ?></span>

        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input value="<?= set_value('password'); ?>" id="password" type="password" name="password" placeholder="Password here">
            <span><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></span>

        </div>
        <div>
            <label for="passwordConf">Confirmation du mot de passe</label>
            <input value="<?= set_value('passwordConf'); ?>" id="passwordConf" type="password" name="passwordConf" placeholder="Confirm Password here">
            <span><?= isset($validation) ? display_form_errors($validation, 'passwordConf') : ''; ?></span>

        </div>
        <br>
        <div>
            <button class="bg-blue-400 text-white p-2 rounded-md">S'inscrire</button>
        </div>
    </form>
    <br>
    <br>
    <a href="<?= base_url('auth'); ?>">Vous avez déjà un compte ? Se connecter</a>
</body>

</html>
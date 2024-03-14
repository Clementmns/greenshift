<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greeshift - Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/output.css">
</head>

<body>
    <section class="w-screen h-screen flex">

        <div class="w-1/2 h-full">

        </div>

        <div class="w-1/2 h-screen flex justify-center items-center ">
            <div class=" flex flex-col items-center justify-between h-2/4 ">
                <h1 class="text-4xl">Se connecter</h1>
                <?php $failMessage = session()->getFlashdata('fail'); ?>
                <?php if ($failMessage) : ?>
                    <div style="color: red;">
                        <?= esc($failMessage) ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('auth/loginUser') ?>" method="post" class="flex flex-col w-[65%]">
                    <?= csrf_field(); ?>
                    <span></span>
                    <div class=>
                        <label for="pseudo">Pseudo : </label>
                        <div class="">
                            <input value="<?= set_value('pseudo'); ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full" id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo">
                            <span><?= isset($validation) ? display_form_errors($validation, 'pseudo') : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-2">
                        <label for="password">Mot de passe : </label>
                        <div class="">
                            <input value="<?= set_value('password'); ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full" id="password" type="password" name="password" placeholder="Votre mot de passe">
                            <span><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-10 self-center">
                        <button class="bg-primary text-white p-2 rounded-md">Connexion</button>
                    </div>
                </form>
                <p>Vous n'avez toujours pas de compte ? <a class="text-primary" href="<?= base_url('auth/register'); ?>">Inscription</a></p>
            </div>
        </div>

    </section>
</body>

</html>
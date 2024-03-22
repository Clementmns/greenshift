<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greeshift - Connexion</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/output.css">
</head>

<body>
    <?php
    echo view("templates/notification");
    ?>
    <section class="w-screen h-screen flex flex-col items-center justify-center ">

        <div class="w-full h-1/4 bg-cover bg-center flex items-center justify-center rounded-b-3xl shadow-3xl" style="background-image: url('<?= base_url() ?>/assets/img/auth-bg.jpeg');">
            <div class="w-full h-full flex flex-col justify-center items-center">
                <h1 class="text-white text-7xl shadow-white">Greenshift</h1>
            </div>
        </div>




        <div class="w-full h-3/4 flex justify-center items-center">
            <div class=" flex flex-col items-center justify-evenly h-full w-[80%]">
                <h2 class="text-5xl">Connexion</h2>
                <?php $failMessage = session()->getFlashdata('fail'); ?>
                <?php if ($failMessage) : ?>
                    <p style="color: red;">
                        <?= esc($failMessage) ?>
                    </p>
                <?php endif; ?>
                <form action="<?= base_url('auth/loginUser') ?>" method="post" class="flex flex-col w-full p-10">
                    <?= csrf_field(); ?>
                    <div>
                        <label for="pseudo">Pseudo : </label>
                        <div>
                            <input value="<?= set_value('pseudo'); ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo">
                            <span class="text-red-500"><?= isset($validation) ? display_form_errors($validation, 'pseudo') : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-2">
                        <label for="password">Mot de passe : </label>
                        <div>
                            <input value="<?= set_value('password'); ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" id="password" type="password" name="password" placeholder="Votre mot de passe">
                            <span class="text-red-500"><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-10 self-center">
                        <button class="bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg hover:bg-white hover:text-primary-500 hover:ring-2 hover:ring-primary-500  transition-all">Se connecter</button>
                    </div>
                </form>
                <p class="text-center">Vous n'avez toujours pas de compte ? <a class="text-primary-500 hover:underline transition-all" href="<?= base_url('auth/register'); ?>">Inscrivez-vous</a></p>
            </div>
        </div>

    </section>
</body>

</html>
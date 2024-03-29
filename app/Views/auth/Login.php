<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Connexion</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/output.css">
    <script src="<?= base_url(); ?>js/jquery/dist/jquery.min.js"></script>
</head>

<body>

    <section class="w-screen h-screen flex flex-col items-center justify-center landscape:flex-row">

        <div class="w-full h-1/4 landscape:h-full bg-cover bg-center flex items-center justify-center rounded-b-3xl landscape:rounded-b-none landscape:rounded-r-3xl shadow-3xl" style="background-image: url('<?= base_url() ?>/assets/img/auth-bg.jpeg');">
            <div class="w-full h-full flex flex-col justify-center items-center">
                <h1 class="text-white text-7xl shadow-white">Greenshift</h1>
            </div>
        </div>




        <div class="w-full h-3/4 flex justify-center items-center">
            <div class=" flex flex-col items-center justify-evenly h-full w-full landscape:w-[30vw]">
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
                            <span class="leading-tight text-red-500"><?= isset($validation) ? 'pseudo incorrect' : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-2">
                        <label for="password">Mot de passe : </label>
                        <div>
                            <input value="<?= set_value('password'); ?>" class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" id="password" type="password" name="password" placeholder="Votre mot de passe">
                            <span class="leading-tight text-red-500"><?= isset($validation) ? 'mot de passe incorrect' : ''; ?></span>
                        </div>

                    </div>
                    <div class="mt-10 self-center">
                        <button class="bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg">Se connecter</button>
                    </div>
                </form>
                <p class="text-center mx-10">Vous n'avez toujours pas de compte ? <br> <a class="text-primary-500 underline l" href="<?= base_url('register'); ?>">Inscrivez-vous</a></p>
            </div>
        </div>

    </section>

    <?php
    echo view("templates/notification");
    ?>
</body>

</html>
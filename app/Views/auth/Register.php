<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenshift - Inscription</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/output.css">
    <script src="<?= base_url(); ?>js/jquery/dist/jquery.min.js"></script>
</head>

<body>

    <section class="w-screen h-screen flex flex-col items-center justify-center landscape:flex-row">

        <div class="w-full h-1/4 bg-cover landscape:h-full bg-center flex items-center justify-center landscape:rounded-b-none landscape:rounded-r-3xl rounded-b-3xl shadow-3xl" style="background-image: url('<?= base_url() ?>/assets/img/auth-bg.jpeg');">
            <div class="w-full h-full flex flex-col justify-center items-center">
                <h1 class="text-white text-7xl shadow-white">Greenshift</h1>
            </div>
        </div>

        <div class="w-full h-3/4 flex justify-center items-center">
            <div class="w-full flex flex-col items-center justify-between h-[60vh] landscape:w-[30vw]">
                <h2 class="text-5xl">Inscription</h2>

                <form action="<?= base_url('auth/registerUser') ?>" method="post" class="flex flex-col w-full p-10 pt-2">
                    <?= csrf_field(); ?>
                    <div class="mt-1 flex justify-between">
                        <div class="w-[45%]">
                            <label for="firstname">Prénom</label>
                            <div>
                                <input class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" value="<?= set_value('firstname'); ?>" id="firstname" type="text" name="firstname" placeholder="Ex: Titouan">
                                <span class="leading-none text-red-500 text-sm"><?= isset($validation) ? 'Le prénom est requis' : ''; ?></span class="leading-none text-red-500">
                            </div>
                        </div>
                        <div class="w-[45%]">
                            <label for="lastname">Nom</label>
                            <div>
                                <input class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" value="<?= set_value('lastname'); ?>" id="lastname" type="text" name="lastname" placeholder="Ex: Lahchiouach">
                                <span class="leading-none text-red-500 text-sm"><?= isset($validation) ? 'Le nom est requis' : ''; ?></span class="leading-none text-red-500">
                            </div>
                        </div>

                    </div>
                    <div class="mt-1">
                        <label for="pseudo">Pseudo</label>
                        <div>

                            <input class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" value="<?= set_value('pseudo'); ?>" id="pseudo" type="text" name="pseudo" placeholder="Ex: titlah">
                            <span class="leading-none text-red-500 text-sm"><?= isset($validation) ? 'Le pseudo complet est requis' : ''; ?></span class="leading-none text-red-500">
                        </div>

                    </div>
                    <div class="mt-1">
                        <label for="password">Mot de passe</label>
                        <div>


                            <input class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" value="<?= set_value('password'); ?>" id="password" type="password" name="password" placeholder="Ex: motdepasse1234">
                            <span class="leading-none text-red-500 text-sm"><?= isset($validation) ? 'Le mot de passe est requis de + de 5 charactères' : ''; ?></span class="leading-none text-red-500">
                        </div>
                    </div>
                    <div class="mt-1">
                        <label for="passwordConf">Confirmer le mot de passe</label>
                        <div>
                            <input class="bg-gray-100 p-1 rounded-lg ring-2 ring-gray-200 w-full shadow-md" value="<?= set_value('passwordConf'); ?>" id="passwordConf" type="password" name="passwordConf" placeholder="Ex: motdepasse1234">
                            <span class="leading-none text-red-500 text-sm"><?= isset($validation) ? 'Les mots de passe doivent être identiques' : ''; ?></span class="leading-none text-red-500">
                        </div>
                    </div>
                    <div class="self-center">
                        <button class="mt-10 bg-primary-500 text-white pl-3 pr-3 pb-2 pt-2 rounded-md shadow-lg">S'inscrire</button>
                    </div>

                </form>

                <p class="text-center mx-10">Vous avez déjà un compte ? <br> <a class="text-primary-500 underline transition-all" href="<?= base_url('login'); ?>"> Se connecter</a></p>
            </div>
        </div>

    </section>

    <?php
    echo view("templates/notification");
    ?>
</body>

</html>
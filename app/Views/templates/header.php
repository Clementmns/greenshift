<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/output.css">
    <title>GreenShift - Accueil</title>
    <script src="<?= base_url(); ?>js/jquery/dist/jquery.min.js"></script>
</head>

<body class="bg-primary-500">
    <div class="w-screen fixed z-[100] h-screen menuPopup transition-all" style="transform: translateX(-2000px);"><?php echo view('settings/index') ?></div>
    <header class="fixed top-0 w-full bg-primary-500 h-28 flex justify-between items-center p-6 z-50 landscape:justify-start landscape:gap-10">
        <div class="flex items-center gap-4">
            <div class="menuOpenPopup cursor-pointer">
                <img class=" inline-block h-8 !w-8 " src="<?= base_url() ?>assets/icons/menu.png" alt="">
            </div>
            <div class="menuOpenPopup flex gap-3 items-center justify-center cursor-pointer">
                <img class="inline-block h-14 !w-14 rounded-xl ring-[2.5px] ring-primary-300 object-cover" src="<?= base_url() ?>assets/avatar/<?= $userInfo['avatar']; ?>" alt="">
                <div class="flex flex-col leading-tight text-white">
                    <p class="p-0 m-0">Salut,</p>
                    <p class="font-bold p-0 m-0"><?= $userInfo['pseudo']; ?></p>
                </div>
            </div>
        </div>
        <div class="rounded-md bg-secondary-500 flex items-center p-[2px] pl-1 pr-1 gap-2 linkShop cursor-pointer" data-icon="shop">
            <img class="inline-block h-4 !w-4 " src="<?= base_url() ?>assets/icons/shifter.svg" alt="">
            <p class="font-semibold text-sm"><?= $userInfo['points']; ?></p>
        </div>
    </header>
    <div class="flex justify-center">
        <div class="fixed -z-50 bottom-0 bg-white h-[85vh] w-[180vw] rounded-t-full">
        </div>
    </div>
    <main class="mt-28  px-6 mb-24 wrapper flex justify-center items-center">

        <script>
            $(document).ready(function() {
                $(".linkShop").on('click', function() {
                    $('.icon-button').removeClass('border-b-2 border-primary-400');
                    $('.icon-button').css('transform', 'translateY(0)');

                    // Récupérez l'attribut data-icon du bouton cliqué
                    let attribut = $(this).attr('data-icon');

                    // Cachez toutes les div.container
                    $('.container').fadeOut(50);
                    setTimeout(() => {
                        // Affichez la page correspondante en fonction du bouton cliqué

                        $('.shop').fadeIn(50);
                        $('.shopNav').addClass('border-b-2 border-primary-400');
                        $('.shopNav').css('transform', 'translateY(-7px)');

                    }, 100);

                    // Enregistrez la dernière page visitée dans localStorage
                    localStorage.setItem('lastVisitedPage', attribut);
                });
            });
        </script>
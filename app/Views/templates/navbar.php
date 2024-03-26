<nav class="fixed bottom-0 left-0 w-full  z-[43] h-16">
    <div class="box rounded-t-3xl rounded-b-none p-2 ">
        <ul class="flex justify-around">
            <li class="icon-button transition-all p-3 m-0 landscape:hover:border-b-2 landscape:hover:border-primary-500 cursor-pointer" data-icon="home"><img src="<?= base_url("assets/icons/maison.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button transition-all p-3 m-0 landscape:hover:border-b-2 landscape:hover:border-primary-500 cursor-pointer" data-icon="ranking"><img src="<?= base_url("assets/icons/trophee.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button transition-all p-3 m-0 landscape:hover:border-b-2 landscape:hover:border-primary-500 cursor-pointer" data-icon="badges"><img src="<?= base_url("assets/icons/badge.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="shopNav icon-button transition-all p-3 m-0 landscape:hover:border-b-2 landscape:hover:border-primary-500 cursor-pointer" data-icon="shop"><img src="<?= base_url("assets/icons/panier.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <?php if ($userInfo['role'] == 1) {
                echo "<li class='transition-all icon-button p-3 m-0 landscape:hover:border-b-2 landscape:hover:border-primary-500 cursor-pointer' data-icon='admin'><img src='" . base_url("assets/icons/admin.svg") . "' alt='Icone 5' class='w-6 h-6 object-cover'></a></li>";
            } ?>
        </ul>
    </div>
</nav>
<script>
    // Ajoutez un gestionnaire d'événements à tous les boutons d'icône
    $('.icon-button').click(function() {
        // Remove active class from all buttons
        $('.icon-button').removeClass('border-b-2 border-primary-400');

        // Add active class to the clicked button
        $(this).addClass('border-b-2 border-primary-400');

        // Reset translateY for all buttons
        $('.icon-button').css('transform', 'translateY(0)');

        // Lift the clicked icon
        $(this).css('transform', 'translateY(-7px)');

        // Récupérez l'attribut data-icon du bouton cliqué
        let attribut = $(this).attr('data-icon');

        // Cachez toutes les div.container
        $('.container').fadeOut(50);
        setTimeout(() => {
            // Affichez la page correspondante en fonction du bouton cliqué
            if (attribut == "home") {
                $('.home').fadeIn(50);
            } else if (attribut == "ranking") {
                $('.ranking').fadeIn(50);
            } else if (attribut == "badges") {
                $('.badges').fadeIn(50);
            } else if (attribut == "shop") {
                $('.shop').fadeIn(50);
            } else if (attribut == "admin") {
                $('.admin').fadeIn(50);
            }
        }, 100);

        // Enregistrez la dernière page visitée dans localStorage
        localStorage.setItem('lastVisitedPage', attribut);
    });
    // Affichez la dernière page visitée lors du chargement de la page
    let lastVisitedPage;
    if (localStorage.getItem('lastVisitedPage')) {
        lastVisitedPage = localStorage.getItem('lastVisitedPage');
    } else {
        lastVisitedPage = 'home';
    }

    if (lastVisitedPage) {
        $('.' + lastVisitedPage).fadeIn(200);
        $('.icon-button[data-icon="' + lastVisitedPage + '"]').addClass('border-b-2 border-primary-400').css('transform', 'translateY(-7px)');
    }
</script>
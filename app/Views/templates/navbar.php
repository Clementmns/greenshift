<nav class="fixed bottom-0 left-0 w-full  z-[43]">
    <div class="box rounded-t-3xl rounded-b-none p-2 ">
        <ul class="flex justify-around">
            <li class="icon-button p-3 m-0 border-b-2 border-primary-400 translate-y-[-7px] " data-icon="home"><img src="<?= base_url("assets/icons/maison.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0" data-icon="classement"><img src="<?= base_url("assets/icons/trophee.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0" data-icon="badges"><img src="<?= base_url("assets/icons/badge.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0" data-icon="shop"><img src="<?= base_url("assets/icons/panier.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
        </ul>
    </div>
</nav>
<script>
    $('.icon-button').click(function() {
        // Remove active class from all buttons
        $('.icon-button').removeClass('border-b-2 border-primary-400');

        // Add active class to the clicked button
        $(this).addClass('border-b-2 border-primary-400');

        // Reset translateY for all buttons
        $('.icon-button').css('transform', 'translateY(0)');

        // Lift the clicked icon
        $(this).css('transform', 'translateY(-7px)');

        let attribut = $(this).attr('data-icon');

        $('.container').fadeOut(200);
        setTimeout(() => {

            if (attribut == "home") {
                $('.home').fadeIn(200);
            } else if (attribut == "classement") {
                $('.ranking').fadeIn(200);
            } else if (attribut == "badges") {
                $('.badges').fadeIn(200);
            } else {
                $('.shop').fadeIn(200);
            }
        }, 200);

        // Show the corresponding page based on the clicked icon

    });
</script>
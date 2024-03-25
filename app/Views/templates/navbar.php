<nav class="fixed bottom-0 left-0 w-full  z-[43]">
    <div class="box rounded-t-3xl rounded-b-none p-2 ">
        <ul class="flex justify-around">
            <li class="icon-button p-3 m-0 border-b-2 border-primary-400"><img src="<?= base_url("assets/icons/maison.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0 "><img src="<?= base_url("assets/icons/trophee.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0 "><img src="<?= base_url("assets/icons/badge.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
            <li class="icon-button p-3 m-0 "><img src="<?= base_url("assets/icons/panier.svg"); ?>" alt="Icone 5" class="w-6 h-6 object-cover"></a></li>
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
    });
</script>
<?php
echo view("templates/header");
echo view("templates/notification");

$friends = ["rankingFriend" => $rankingFriend];
$world = ["rankingFriend" => $rankingWorld];
?>

<div id="popup" class="overflow-y-auto hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-start z-50">
   <div class="bg-white p-4 rounded-md w-[90%] mt-44 min-h-20 flex flex-col justify-center max-h-[50vh]">
      <?php
      echo view("relation/search");
      ?>
   </div>
</div>



<div class="box">
   <div class="h-12 flex items-center justify-around mb-4" id="tabButtons">
      <button id="friendsTab" class="tab-button flex border-b-2 border-primary-400 translate-y-[-7px] justify-center gap-2 items-center p-2 transition-all" data-classement="Amis">
         <img class=" inline-block h-6 w-6" src="<?= base_url() ?>assets/icons/user.svg" alt="">
         <p>Amis</p>
      </button>
      <button id="worldTab" class="tab-button flex justify-center gap-2 items-center p-2 transition-all" data-classement="Mondial">
         <img class=" inline-block h-6 w-6" src="<?= base_url() ?>assets/icons/world.svg" alt="">
         <p>Mondial</p>
      </button>
   </div>
   <div class="classement-ami">
      <?php echo view("classement/index", $friends); ?>
   </div>
   <div class="classement-mondial hidden">
      <?php echo view("classement/index", $world); ?>
   </div>

</div>
<button id="" class="toggle-addFriend w-full flex justify-center items-center gap-2 p-3 box my-6 bg-primary-500 text-white">
   <img class="inline-block h-8 !w-8" src="<?= base_url() ?>assets/icons/friend_add.svg" alt="">
   <p class="text-lg font-bold">Ajouter un ami</p>
</button>


<script>
   $('.toggle-addFriend').on('click', function() {
      // Mettre le contenu de full-description et titre dans le popupContent et popupTitle
      $('#popup').removeClass('hidden');
   });


   $('#closePopup').click(function() {
      $('#popup').addClass('hidden');
   });

   $('#popup').click(function(event) {
      if (event.target === this) {
         $(this).addClass('hidden');
      }
   });

   $('.tab-button').click(function() {
      // Remove active class from all buttons
      $('.tab-button').removeClass('border-b-2 border-primary-400');

      // Add active class to the clicked button
      $(this).addClass('border-b-2 border-primary-400');

      // Reset translateY for all buttons
      $('.tab-button').css('transform', 'translateY(0)');

      // Lift the clicked tab
      $(this).css('transform', 'translateY(-7px)');

      // Get the classement text from data attribute
      if ($(this).attr('data-classement') == "Mondial") {
         $('.classement-ami').fadeOut(200, function() {
            $('.classement-ami').addClass('hidden');
            $('.classement-mondial').fadeIn(200).removeClass('hidden');
         });
      } else {
         $('.classement-mondial').fadeOut(200, function() {
            $('.classement-mondial').addClass('hidden');
            $('.classement-ami').fadeIn(200).removeClass('hidden');
         });
      }
   });
</script>




<?php
echo view("templates/footer");
?>
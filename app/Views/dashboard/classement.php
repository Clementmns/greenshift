<?php
$friends = ["rankingFriend" => $rankingFriend];
$world = ["rankingFriend" => $rankingWorld];

$search = view("relation/search");
?>
<div>
   <div id="popupFriend" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-start z-50 hidden">
      <div class="bg-white p-4 rounded-md w-[90%] landscape:w-[30vw] mt-44 min-h-20 flex flex-col justify-center max-h-[70vh]">
         <?php echo $search ?>
      </div>
   </div>

   <div id="popupProfile" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-start z-50 hidden">
      <div class="bg-white p-4 rounded-md w-[90%] landscape:w-[30vw] mt-44 min-h-20 flex flex-col justify-center max-h-[70vh]">
         <div id="profileFriend"></div>
      </div>
   </div>



   <div class="box landscape:hidden">
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
      <div class="classement-ami overflow-y-auto p-3 max-h-[50vh]">
         <?php echo view("classement/index", $friends); ?>
      </div>
      <div class="classement-mondial hidden overflow-y-auto p-3 max-h-[50vh]">
         <?php echo view("classement/index", $world); ?>
      </div>

   </div>

   <div class="box portrait:hidden">
      <div class="h-12 flex items-center justify-around mb-4" id="tabButtons">
         <div id="friendsTab" class=" flex justify-center gap-2 items-center p-2 transition-all" data-classement="Amis">
            <img class=" inline-block h-6 w-6" src="<?= base_url() ?>assets/icons/user.svg" alt="">
            <p>Amis</p>
         </div>
         <div id="worldTab" class="flex justify-center gap-2 items-center p-2 transition-all" data-classement="Mondial">
            <img class=" inline-block h-6 w-6" src="<?= base_url() ?>assets/icons/world.svg" alt="">
            <p>Mondial</p>
         </div>
      </div>
      <div class="flex w-full">
         <div class="overflow-y-auto p-3 max-h-[50vh] w-full">
            <?php echo view("classement/index", $friends); ?>
         </div>
         <div class="overflow-y-auto p-3 max-h-[50vh] w-full">
            <?php echo view("classement/index", $world); ?>
         </div>
      </div>
   </div>
   <div class="w-full flex justify-center">
      <button id="" class="toggle-addFriend w-full flex justify-center items-center gap-2 p-3 box mt-6 landscape:w-[30vw]  bg-primary-500 landscape:hover:bg-primary-700 transition-all text-white">
         <img class="inline-block h-8 !w-8 " src="<?= base_url() ?>assets/icons/friend_add.svg" alt="">
         <p class="text-lg font-bold">Ajouter un ami</p>
      </button>
   </div>
</div>


<script>
   $('.toggle-addFriend').on('click', function() {
      // Mettre le contenu de full-description et titre dans le popupContent et popupTitle
      $('#popupFriend').removeClass('hidden');
   });


   $('#closePopup').click(function() {
      $('#popupFriend').addClass('hidden');
   });

   $('#popupFriend').click(function(event) {
      if (event.target === this) {
         $(this).addClass('hidden');
      }
   });

   $('#closePopup').click(function() {
      $('#popupProfile').addClass('hidden');
   });

   $('#popupProfile').click(function(event) {
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
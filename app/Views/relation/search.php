<form class="m-5 box flex justify-between items-center h-10">
   <img class="h-6 w-6" src="<?= base_url() ?>assets/icons/search.png" alt="">

   <input class="search w-full h-8 p-1" type="search" placeholder="Rechercher" autofocus>
</form>

<div id="result"></div>

<script>
   $(document).ready(function() {

      $(".search").on("input", function() {
         const searchTerm = $(this).val();
         const search = $('#result');
         if (searchTerm.length > 0) {
            $.ajax({
               url: "<?= base_url('/dashboard/relation') ?>",
               method: "GET",
               data: {
                  search: searchTerm
               },
               success: function(data) {
                  if (data.length > 0) {
                     $.ajax({
                        url: "<?= base_url('/dashboard/relationView') ?>",
                        method: "GET",
                        data: {
                           data: data
                        },
                        success: function(data2) {


                           $('#result').html(data2);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                           console.error("Error:", textStatus, errorThrown);
                        }
                     });
                  } else {
                     setTimeout(() => {
                        search.empty();
                     }, 100);
                  }
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.error("Error:", textStatus, errorThrown);
               }
            });
         }
         if (searchTerm.length == 0) {

            setTimeout(() => {
               search.empty();
            }, 100);
         }
      });
   });
</script>
<ul>
   <form>
      <label for="search">Rechercher :</label>
      <input class="search" type="text">
   </form>


   <div id="result"></div>
</ul>

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
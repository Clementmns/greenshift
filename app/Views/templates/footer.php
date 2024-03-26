   </main>

   <script>
      $('.menuOpenPopup').on('click', function() {
         $('.menuPopup').css("transform", "translateX(0px)");
      });


      $('.menuClosePopup').on('click', function() {
         $('.menuPopup').css("transform", "translateX(-2000px)");
      });

      $('.menuPopup').on('click', function(event) {
         if (event.target === this) {
            $('.menuPopup').css("transform", "translateX(-2000px)");
         }
      });

      // Calcul de la largeur de la barre de progression
   </script>
   <footer>

      <!-- Votre contenu de pied de page ici -->
      <?php echo view('templates/navbar.php'); ?>


   </footer>

   </body>

   </html>
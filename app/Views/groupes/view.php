<!-- Contruction de la vue sous forme d'un tableau contenant les informations du ou des etudiants 
    
    view.php reçoit deux variables issues du contrôleur etudiants.php

        $etudiants (tableau associatif contenant autant ligne que de etudiants dans la BDD)

        $titre (chaine de caractère du titre de la page)
-->

<table class="border-2 border-collapse">
   <tr class="border-2">
      <th class="border-2">Groupe</th>
   </tr>

   <?php if (!empty($groupes) && is_array($groupes)) : ?>

      <?php foreach ($groupes as $groupe) : ?>
         <tr class="border-2">
            <td class="border-2"><?= esc($groupe['libelle_groupe']) ?></td>

         <?php endforeach; ?>

</table>


<?php else : ?>

   <h3>Pas de etudiants dans la BDD</h3>

   <p>Pour le moment aucun etudiant n'a été déclaré dans l'application.</p>

<?php endif ?>
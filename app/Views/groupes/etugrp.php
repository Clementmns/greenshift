<!-- Contruction de la vue sous forme d'un tableau contenant les informations du ou des etudiants 
    
    view.php reçoit deux variables issues du contrôleur etudiants.php

        $etudiants (tableau associatif contenant autant ligne que de etudiants dans la BDD)

        $titre (chaine de caractère du titre de la page)
-->
<form action="">
   <label for="">Choisir le groupe :</label>
   <select name="groupe" id="" onchange="submit()">
      <option <?php if ($groupe == 31) {
                  echo "selected";
               } ?> value="31">TDA</option>
      <option <?php if ($groupe == 35) {
                  echo "selected";
               } ?> value="35">TDB</option>
      <option <?php if ($groupe == 36) {
                  echo "selected";
               } ?> value="36">TDC</option>
   </select>
</form>

<table class="border-2 border-collapse">
   <tr class="border-2">
      <th class="border-2">Groupe</th>
      <th class="border-2">Nom</th>
      <th class="border-2">Prénom</th>
      <th class="border-2">mail</th>
   </tr>

   <?php if (!empty($etudiantsByIdGroupes) && is_array($etudiantsByIdGroupes)) : ?>

      <?php foreach ($etudiantsByIdGroupes as $etudiantByIdGroupes) : ?>
         <tr class="border-2">
            <td class="border-2"><?= esc($etudiantByIdGroupes['libelle_groupe']) ?></td>
            <td class="border-2"><?= esc($etudiantByIdGroupes['nom_etudiant']) ?></td>
            <td class="border-2"><?= esc($etudiantByIdGroupes['prenom_etudiant']) ?></td>
            <td class="border-2"><?= esc($etudiantByIdGroupes['mail_etudiant']) ?></td>

         <?php endforeach; ?>

</table>


<?php else : ?>

   <h3>Pas de etudiants dans la BDD</h3>

   <p>Pour le moment aucun etudiant n'a été déclaré dans l'application.</p>

<?php endif ?>
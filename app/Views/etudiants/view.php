<!-- Contruction de la vue sous forme d'un tableau contenant les informations du ou des etudiants 
    
    view.php reçoit deux variables issues du contrôleur etudiants.php

        $etudiants (tableau associatif contenant autant ligne que de etudiants dans la BDD)

        $titre (chaine de caractère du titre de la page)
-->

<table class="border-2 border-collapse">
    <tr class="border-2">
        <th class="border-2">Nom</th>
        <th class="border-2">Prénom</th>
        <th class="border-2">mail</th>
    </tr>

    <?php if (!empty($etudiants) && is_array($etudiants)) : ?>

        <?php foreach ($etudiants as $etudiant) : ?>
            <tr class="border-2">
                <td class="border-2"><?= esc($etudiant['nom_etudiant']) ?></td>
                <td class="border-2"><?= esc($etudiant['prenom_etudiant']) ?></td>
                <td class="border-2"><?= esc($etudiant['mail_etudiant']) ?></td>

            <?php endforeach; ?>

</table>


<?php else : ?>

    <h3>Pas de etudiants dans la BDD</h3>

    <p>Pour le moment aucun etudiant n'a été déclaré dans l'application.</p>

<?php endif ?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Index des pages PHP pour accéder à la BDD</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
</head>

<body>

  <header>
    <h1 class="text-lg text-red-600">Liste des fonctionnalitées</h1>
  </header>
  <ul>

    <li><b>Liens vers les pages statiques de l'application</b></li>
    <ul>
      <li><a href='test/' class="text-blue-500 hover:text-blue-200">Une page statique</a></li>
    </ul>

    <li><b>Liens vers des pages dynamiques simples de consultation de la BDD (tables sans clés étrangères)</b>
      <ul>
        <li>
          <a href="etu" class="text-blue-500 hover:text-blue-200">Affichage de la liste des étudiants</a>
        </li>
        <li>

          <a href="grp" class="text-blue-500 hover:text-blue-200">Affichage de la liste des groupes</a>
        </li>
      </ul>
    </li>


    <li><b>Liens vers des pages dynamiques plus complexes de consultation de la BDD (tables avec clés étrangères)</b>
      <ul>
        <li>
          <a href="grpchoose" class="text-blue-500 hover:text-blue-200">Affichage de la liste des étudiants d'un groupe choisi</a>
        </li>
        <li>
          Affichage de la liste des groupes auxquels appartient un étudiant choisi
        </li>
      </ul>
    </li>

  </ul>
</body>

</html>
<?php
  session_start();
  require_once('../../G01_Artiste/fonctions_G01_Artiste.php');
  require_once('../../G01_interprete/fonctions_G01_interprete.php');
  require_once('../fonctions_G01_Oeuvre.php');
  require_once('../../G01_realiser/fonctions_G01_realiser.php');
  require_once('../../etablir_connextion.php');

  $oeuvre = getOeuvreById($_SESSION['idOeuvre']);
  $nom = $oeuvre['oeuvre_nom'];
  $realisation = getListeOeuvreRealiser($_SESSION['idOeuvre']);
  $interpretation = getListeOeuvreInterprete($_SESSION['idOeuvre']);
  echo "<h1>L'Oeuvre : $nom a été interprétée par : </h1>";
  foreach ($interpretation as $interprete) {
      echo "Le personnage <b>" . $interprete['personnage_nom'] . " </b>né en <b>" . $interprete['personnageannedenaissance'] . "</b>";
      echo "<br/>";
  }
    echo "<h1>et réalisée par : </h1>";
    foreach ($realisation as $ligne) {
      $artiste = getArtisteById($ligne['artiste_id']);
      echo "L'artiste<b> " . $artiste['artiste_nom'] . " </b>né Le<b> " . $artiste['artiste_date_de_naissance'] . " </b>d'origine <b>" .
      $artiste['artiste_pays'] . "</b>";
      echo "<br/>";
      echo '<h2><a href="http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_oeuvre.php' . '">Retour</a></h2>';
    }
?>

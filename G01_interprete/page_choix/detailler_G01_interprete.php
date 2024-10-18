<?php
  session_start();
  require_once('../../G01_Artiste/fonctions_G01_Artiste.php');
  require_once('../fonctions_G01_interprete.php');
  require_once('../../G01_Oeuvre/fonctions_G01_Oeuvre.php');
  require_once('../../etablir_connextion.php');

  $oeuvre = getOeuvreById($_SESSION['idOeuvre']);
  $artiste = getArtisteById($_SESSION['idArtiste']);
  $interprete = getInterpreteById($_SESSION['idOeuvre'],$_SESSION['idArtiste']);
  $nom = $interprete['personnage_nom'];
  echo "<h1>Le Personnage : $nom a été interprété par : </h1>";
  echo "L'artiste<b> " . $artiste['artiste_nom'] . " </b>né Le<b> " . $artiste['artiste_date_de_naissance'] . " </b>d'origine <b>" .
  $artiste['artiste_pays'] . "</b>";
  echo "<br/>";
  echo "<h1>Dans : </h1>";
  if($oeuvre['oeuvre_type'] == 'FILM')
    echo "Le Film<b> " . $oeuvre['oeuvre_nom'] . " </b>sorti<b> " . $oeuvre['oeuvre_date_de_sortie'] . "</b>";
  else
    echo "La Série<b> " . $oeuvre['oeuvre_nom'] . " </b>sortie<b> " . $oeuvre['oeuvre_date_de_sortie'] . "</b>";
  echo "<br/>";
  echo '<h2><a href="http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_interprete.php' . '">Retour</a></h2>';
?>

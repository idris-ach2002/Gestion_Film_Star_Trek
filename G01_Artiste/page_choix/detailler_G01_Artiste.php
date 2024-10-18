<?php
  session_start();
  require_once('../fonctions_G01_Artiste.php');
  require_once('../../G01_interprete/fonctions_G01_interprete.php');
  require_once('../../G01_Oeuvre/fonctions_G01_Oeuvre.php');
  require_once('../../G01_realiser/fonctions_G01_realiser.php');
  require_once('../../etablir_connextion.php');

  $artiste = getArtisteById($_SESSION['idArtiste']);
  $nom = $artiste['artiste_nom'];
  $realisation = getListeArtisteRealiser($_SESSION['idArtiste']);
  $interpretation = getListeArtisteInterprete($_SESSION['idArtiste']);
  echo "<h1>Artiste : $nom a interprété</h1>";
  foreach ($interpretation as $interprete) {
      echo "Le personnage<b> " . $interprete['personnage_nom'] . " </b>né en<b> " . $interprete['personnageannedenaissance'] . "</b>";
      echo "<br/>";
  }
    echo "<h1>et réalisé : </h1>";
    foreach ($realisation as $ligne) {
      $oeuvre = getOeuvreById($ligne['oeuvre_id']);
      if($oeuvre['oeuvre_type'] == 'FILM')
        echo "Le Film<b> " . $oeuvre['oeuvre_nom'] . " </b>sorti<b> " . $oeuvre['oeuvre_date_de_sortie'] . "</b>";
      else
        echo "La Série<b> " . $oeuvre['oeuvre_nom'] . " </b>sortie<b> " . $oeuvre['oeuvre_date_de_sortie'] . "</b>";
      echo "<br/>";
    }
  echo '<h2><a href="http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_artiste.php' . '">Retour</a></h2>';
?>

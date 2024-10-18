
<?php
session_start();
require_once('fonctions_G01_Artiste.php');
require_once('../G01_interprete/fonctions_G01_interprete.php');
require_once('../G01_realiser/fonctions_G01_realiser.php');
require_once('../etablir_connextion.php');


if(isset($_REQUEST['suppression'])) {
  $idArtiste = $_POST['cache'];
  if(!dependanceArtiste($idArtiste)) {
    deleteArtiste($idArtiste);
    header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_Artiste.php');
    exit;
  }
  else {
    echo "impossible de supprimer cette artiste a cause des Dépandance";
  }
}

if(isset($_REQUEST['modification'])) {
  $_SESSION['idArtiste'] = $_POST['cache'];
  header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_Artiste/page_choix/modification_G01_Artiste.php');
  exit;
}



if(isset($_REQUEST['detail'])) {
  $_SESSION['idArtiste'] = $_POST['cache'];
  header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_Artiste/page_choix/detailler_G01_Artiste.php');
  exit;
}

 ?>

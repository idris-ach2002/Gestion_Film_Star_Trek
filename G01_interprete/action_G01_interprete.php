
<?php
session_start();
require_once('fonctions_G01_interprete.php');
require_once('../etablir_connextion.php');


if(isset($_REQUEST['suppression'])) {
  $idArtiste = $_POST['cache2'];
  $idOeuvre = $_POST['cache1'];
  deleteInterprete($idOeuvre,$idArtiste);
  header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_interprete.php');
  exit;
}

if(isset($_REQUEST['modification'])) {
  $_SESSION['idArtiste'] = $_POST['cache2'];
  $_SESSION['idOeuvre'] = $_POST['cache1'];
  header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_interprete/page_choix/modification_G01_interprete.php');
  exit;
}



if(isset($_REQUEST['detail'])) {
  $_SESSION['idArtiste'] = $_POST['cache2'];
  $_SESSION['idOeuvre'] = $_POST['cache1'];
  header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_interprete/page_choix/detailler_G01_interprete.php');
  exit;
}

 ?>

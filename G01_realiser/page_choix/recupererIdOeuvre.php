<?php
  session_start();
  require_once('../fonctions_G01_realiser.php');
  require_once('../../etablir_connextion.php');
  if(isset($_REQUEST['login'])) {
      $id = $_POST['id_oeuvre'];
      if(count(updateRealiserSelonArtiste(array('oeuvre_id' => $id,'artiste_id' => $_SESSION['idArtiste']))) != 0) {
         header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_realiser.php');
         exit;
       }
  }
?>

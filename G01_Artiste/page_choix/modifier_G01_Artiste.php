<?php
    session_start();
    require_once('../fonctions_G01_Artiste.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $nom = $_POST['nom'];
        $pays = $_POST['pays'];
        $date = $_POST['date_naiss'];
        if(count(updateArtiste(array('artiste_id' => $_SESSION['idArtiste'],'artiste_nom' => $nom,
        'artiste_pays' => $pays,'artiste_date_de_naissance' => $date))) != 0) {
          header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_Artiste.php');
          exit;
        }
    }
?>

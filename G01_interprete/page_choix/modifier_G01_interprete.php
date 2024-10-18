<?php
    session_start();
    require_once('../fonctions_G01_interprete.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $nom = $_POST['nom'];
        $date = $_POST['date_naissance'];
        if(count(updateInterprete(array('personnage_nom' => $nom, 'personnageAnneDeNaissance' => $date,
        'oeuvre_id' => $_SESSION['idOeuvre'],'artiste_id' => $_SESSION['idArtiste']))) != 0) {
           header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_interprete.php');
           exit;
         }
    }
?>

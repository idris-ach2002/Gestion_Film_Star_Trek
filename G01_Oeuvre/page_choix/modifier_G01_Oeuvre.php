<?php
    session_start();
    require_once('../fonctions_G01_Oeuvre.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $date = $_POST['date_sortie'];
        if(count(updateOeuvre(array('oeuvre_id' => $_SESSION['idOeuvre'], 'oeuvre_nom' => $nom,
         'oeuvre_type' => $type, 'oeuvre_date_de_sortie' => $date))) != 0) {
           header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/pages_consultations/consultation_G01_Oeuvre.php');
           exit;
         }
    }
?>

<?php
    require_once('../fonctions_G01_Artiste.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $nom = $_POST['nom'];
        $pays = $_POST['pays'];
        $date = $_POST['date_naiss'];
        if(count(insertArtiste(array('artiste_nom' => $nom,'artiste_pays' => $pays,'artiste_date_de_naissance' => $date))) != 0)
          echo "Insertion effectuée";
    }
?>

<?php
    require_once('../fonctions_G01_Oeuvre.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $date = $_POST['date_sortie'];
        if(count(insertOeuvre(array('oeuvre_nom' => $nom, 'oeuvre_type' => $type, 'oeuvre_date_de_sortie' => $date))) != 0)
          echo "Insertion effectuée";
    }
?>

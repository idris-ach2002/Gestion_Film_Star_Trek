<?php
    require_once('../fonctions_G01_realiser.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $id1 = $_POST['id_oeuvre'];
        $id2 = $_POST['id_artiste'];
        $realiser = array('oeuvre_id' => $id1,'artiste_id' => $id2);
        if(insertionPossibleRealiser($realiser)) {
            insertRealiser($realiser);
            echo "Insertion a été bien effectuée <br/>";
        }else {
            echo "Insertion impossible clé déjà existe dans la table <br/>";
        }
    }
?>

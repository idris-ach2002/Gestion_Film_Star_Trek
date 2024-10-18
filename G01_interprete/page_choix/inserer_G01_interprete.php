<?php
    require_once('../fonctions_G01_interprete.php');
    require_once('../../etablir_connextion.php');
    if(isset($_REQUEST['login'])) {
        $id1 = $_POST['id_oeuvre'];
        $id2 = $_POST['id_artiste'];
        $nom = $_POST['nom'];
        $annee = $_POST['annee'];
        $identifiant = array('oeuvre_id' => $id1,'artiste_id' => $id2);
        $interprete = array('personnage_nom' => $nom, 'personnageAnneDeNaissance' => $annee,'oeuvre_id' => $id1,'artiste_id' => $id2);
        if(insertionPossibleInterprete($identifiant)) {
            insertInterprete($interprete);
            echo "Insertion a été bien effectuée <br/>";
        }else {
            echo "Insertion impossible clé déjà existe dans la table <br/>";
        }
    }
?>

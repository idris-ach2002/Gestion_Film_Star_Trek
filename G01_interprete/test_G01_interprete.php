<?php
require_once('fonctions_G01_interprete.php');
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G01_Interprete</title>
</head>
<body>

<table border="2" cellspacing="10" cellpadding="5">
    <?php
        //l'affichage de toutes la table sous forme tableau
        echo structurerContenuInterprete();
    ?>
</table>

</body>
</html>


<?php

    function affichageTableau(array $tab) : void {
        foreach($tab as $key => $value) {
            echo $key . " -> " . $value . "  ";
        }
        echo "<br/>";
    }
    //obtention d'un enregistrement

    $id1 = 2;
    $id2 = 3;
    $ligne =  getInterpreteById($id1,$id2);
    affichageTableau($ligne);

    //insertion d'un enregistrement
  /*  $nom = "valencia";
    $date = "2050";
    $id1 = 3; // a renseigner sionon erreur car cle etrangère sa valeur correspond à une val licite d'une cle primère
    $id2 = 5; // pareil
    $tab = array('personnage_nom' => $nom, 'personnageAnneDeNaissance' => $date,'oeuvre_id' => $id1, 'artiste_id' => $id2);
    if(existanceIdInterprete($id1, $id2) && insertionPossibleInterprete(array($id1,$id2))) {
      $ligne = insertInterprete($tab);
      affichageTableau($ligne);
    }else {
      echo "insertion impossible à cause des dépendance";
    }*/


    // mise à jour
  /*  $ligne['personnage_nom'] = 'lucas';
    $ligne['personnageAnneDeNaissance'] = '2070';
    $ligne = updateInterprete($ligne);
    affichageTableau($ligne);*/

    //supression possible
    deleteInterprete($id1,$id2);
?>

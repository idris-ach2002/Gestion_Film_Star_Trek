
<?php
    require_once('fonctions_G01_realiser.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G01_realiser</title>
</head>
<body>

<table border="2" cellspacing="10" cellpadding="5">
    <?php
        //l'affichage de toutes la table sous forme tableau
        echo structurerContenuRealiser();
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

    $id1 = 1; $id2 = 2;
    $ligne =  getRealiserById($id1,$id2);
    affichageTableau($ligne);

    //insertion d'un enregistrement
    /*$tab = array('oeuvre_id' => $id1, 'artiste_id' => $id2);
    if(existanceIdRealiser($id1,$id2) && insertionPossibleRealiser(array($id1,$id2))) {
      $ligne = insertRealiser($tab);
      affichageTableau($ligne);
    }else {
      echo "insertion impossible à cause des dépendance<br/>";
    }*/


    // mise à jour a renseigner auprès de professeur
    // la mise à jour n'a pas de sens dans la table realiser
    //updateRealiser(array('oeuvre_id' => $id1, 'artiste_id' => $id2));
    //supression
    //deleteRealiser($id1,$id2);



?>

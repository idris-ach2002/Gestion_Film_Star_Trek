

<?php
require_once('fonctions_G01_Oeuvre.php');
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G01_Oeuvre</title>
</head>
<body>

<table border="2" cellspacing="10" cellpadding="5">
    <?php
        //l'affichage de toutes la table sous forme tableau
        echo structurerContenuOeuvre();
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

    $id = 21;
    $ligne =  getOeuvreById($id);
    affichageTableau($ligne);

    //insertion d'un enregistrement
    /*$nom = "star trek beyond limits";
    $type = "SERIE";
    $date = "2002/12/05";
    $tab = array('oeuvre_nom' => $nom, 'oeuvre_type' => $type, 'oeuvre_date_de_sortie' => $date);
    $ligne = insertOeuvre($tab);
    affichageTableau($ligne);*/

    // mise à jour
    //identifiant ici c'est celui généré automati on le connait grâce a la fonction insert() requette max(ouvre_id)
    $ligne['oeuvre_id'] = 16;
    $ligne['oeuvre_nom'] = 'star trek final 2';
    $ligne['oeuvre_type'] = 'FILM';
    $ligne['oeuvre_date_de_sortie'] = '1980/02/20';
    if(dependanceOeuvre($ligne['oeuvre_id'])) {
      echo "impossible de modifier y'a une table qui dépend de cette cle";
    }else {
      $ligne = updateOeuvre($ligne);
      affichageTableau($ligne);
    }


    //supression   possible car la table interprete et realiser ne dépend pas de cette cle
    // c'est une nouvelle cle que on a pas insérer dans interprete et realise
    if(dependanceOeuvre($id)) {
        echo "impossible de supprimer y'a une table qui dépend de cette cle";
    }else
      deleteOeuvre($id);



?>

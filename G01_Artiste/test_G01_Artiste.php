<?php
require_once('fonctions_G01_Artiste.php');
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
        echo structurerContenuArtiste();
    ?>
</table>

</body>
</html>



<?php

    function affichageTableau(array $tab) : void {
        foreach($tab as $key => $value) {
            echo $key . " -> " . $value . "  ";
        }
    }
    $id = 18;
    //obtention d'un enregistrement
    /*$ligne =  getArtisteById($id);
    affichageTableau($ligne);*/
    //insertion d'un enregistrement
    /*$nom = "lukako";
    $pays = "allemagne";
    $date = "1960/12/19";
    $tab = array('artiste_nom' => $nom, 'artiste_pays' => $pays, 'artiste_date_de_naissance' => $date);
    $ligne = insertArtiste($tab);
    affichageTableau($ligne);/*

     //mise à jour
    //identifiant ici c'est celui généré automati on le connait grâce a la fonction insert() requette max(artiste_id)
    $ligne['artiste_id'] = 16;
    $ligne['artiste_nom'] = 'jhon';
    $ligne['artiste_pays'] = 'canada';
    $ligne['artiste_date_de_naissance'] = '1970/10/15';
    echo dependanceArtiste($id);
    if(!dependanceArtiste($id)) {
      $ligne = updateArtiste($ligne);
      affichageTableau($ligne);
    } else {
        echo "impossible de modifier y'a une table qui dépend de cette clé";
    }

    //supression   possible car la table interprete et realiser ne dépend pas de cette cle
    //c'est une nouvelle cle que on a pas insérer dans interprete et realise
    //;*/
    if(dependanceArtiste($id))
      echo "impossible de supprimer y'a une table qui dépend de cette cle";
    else {
      deleteArtiste($id);
    }

?>

<?php
  require_once('../../G01_Oeuvre/fonctions_G01_Oeuvre.php');
  require_once('../../G01_Artiste/fonctions_G01_Artiste.php');
  require_once('../../etablir_connextion.php');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page D'enregistrement</title>
</head>
<body>
    <form action="inserer_G01_interprete.php" method="post">

        <h1>Renseignement d'information</h1>


        <table border="2" cellspacing="10" cellpadding="5">
            <tr>  <th>Nom Personnage</th>  <th><input type="text" name="nom" size="5" required/></th>  </tr>
            <tr>  <th>Personnage année de naissance</th>  <th><input type="number" name="annee" size="5" required/></th>  </tr>



            <tr>
              <th>Nom de l'oeuvre</th>
              <th>
                <?php

                     $list1 = getListIdOeuvre();
                     $resultat = '<select name="id_oeuvre" size="10">';
                     foreach($list1 as $ligne) {
                         foreach ($ligne as $value) {
                             $oeuvre = getOeuvreById($value);
                               $resultat .= '<option value="' . $value . '" >' . $oeuvre["oeuvre_nom"] . '</option>';
                           }
                         }

                     $resultat .= '</select>';
                     echo $resultat;
                 ?>
              </th>
            </tr>

            <tr>
              <th>Nom de l'artiste</th>
              <th>
                <?php

                    $list1 = getListIdArtiste();
                    $resultat = '<select name="id_artiste" size="10">';
                    foreach($list1 as $ligne) {
                        foreach ($ligne as $key => $value) {
                          $artiste = getArtisteById($value);
                            $resultat .= '<option value="' . $value . '" >' . $artiste["artiste_nom"] . '</option>';
                        }
                    }
                    $resultat .= '</select>';
                    echo $resultat;
                ?>
              </th>
            </tr>

            <tr>
              <th><input type="submit" name="login" value="valider" /></th>
              <th><input type="reset" name="logout" value="réinitialiser" /></th>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
session_start();
require_once('../fonctions_G01_Artiste.php');
require_once('../../etablir_connextion.php');
$artiste = getArtisteById($_SESSION['idArtiste']);
$res = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page De modification</title>
</head>
<body>
    <form action="modifier_G01_Artiste.php" method="post">
        <h1>Renseignement' . "d'information</h1>" .
        '<table border="2" cellspacing="10" cellpadding="10">
          <tr> <th>Nom_Artiste</th> <th> <input type="text" name="nom" value="'
          . $artiste['artiste_nom'] .'" size="10" required/> </th>  </tr>'.
          '<tr> <th>Pays_Artiste</th>  <th> <input type="text" name="pays" value="'
          . $artiste['artiste_pays'] . '" size="10" required/> </th>  </tr>' .
          '<tr> <th>Date_De_Naissance_Artiste</th>  <th> <input type="date" name="date_naiss" value="'
          . $artiste['artiste_date_de_naissance'] . '" size="10" required" /> </th>  </tr>' .
          '            <tr>
                            <th> <input type="submit" name="login" value="valider"/> </th>
                            <th> <input type="reset" name="logout" value="réinitialiser"/> </th>
                        </tr>
                  </table>
              </form>

          </body>
          </html>';

      echo $res;

 ?>

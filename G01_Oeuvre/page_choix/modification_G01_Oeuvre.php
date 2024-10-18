<?php
session_start();
require_once('../fonctions_G01_Oeuvre.php');
require_once('../../etablir_connextion.php');
$oeuvre = getOeuvreById($_SESSION['idOeuvre']);

$res = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page De modification</title>
</head>
<body>
    <form action="modifier_G01_Oeuvre.php" method="post">

        <h1>Renseignement d\'information</h1>

        <table border="2" cellpadding="10" cellspacing="5">

            <tr> <th>Nom_Oeuvre</th>  <th> <input type="text" name="nom" size="10" value="'
            . $oeuvre['oeuvre_nom'] . '" required/> </th></tr>';
        $res .= $oeuvre['oeuvre_type'] == "FILM" ?
        '      <tr>
                  <th>Type_Oeuvre</th>
                  <th>FILM <input type="radio" name="type" value="FILM" checked="checked"/> </th>
                  <th>SERIE <input type="radio" name="type" value="SERIE" /> </th>
              </tr>'
              :
              '<tr>
                  <th>Type_Oeuvre</th>
                  <th>FILM <input type="radio" name="type" value="FILM" /> </th>
                  <th>SERIE <input type="radio" name="type" value="SERIE" checked="checked" /> </th>
              </tr>';

            $res .= '  <tr>  <th>Date_De_Sortie_Oeuvre</th>  <th><input type="date" name="date_sortie" size="10"
            value="'.  $oeuvre["oeuvre_date_de_sortie"] . '" required/> </th> </tr>';

            $res .= '
            <tr>
                <th> <input type="submit" name="login" value="valider"/> </th>
                <th> <input type="reset" name="logout" value="réinitialiser"/> </th>
            </tr>
        </table>
    </form>
</body>
</html>  ' ;

echo $res;
?>

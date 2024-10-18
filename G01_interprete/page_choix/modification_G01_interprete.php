<?php
session_start();
require_once('../fonctions_G01_interprete.php');
require_once('../../etablir_connextion.php');
$interprete = getInterpreteById($_SESSION['idOeuvre'],$_SESSION['idArtiste']);

$res = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page De modification</title>
</head>
<body>
    <form action="modifier_G01_interprete.php" method="post">

        <h1>Renseignement d\'information</h1>

        <table border="2" cellpadding="10" cellspacing="5">
            <tr> <th>Nom_Personnage</th>  <th> <input type="text" name="nom" value="' .
             $interprete['personnage_nom'] . '" size="10" required/> </th></tr>


            <tr>  <th>Personnage_Anne_De_Naissance</th>  <th><input type="number" name="date_naissance" value="'
             . $interprete['personnageannedenaissance'] .
            '" size="10" required/> </th> </tr>

            <tr>
                <th> <input type="submit" name="login" value="valider"/> </th>
                <th> <input type="reset" name="logout" value="réinitialiser"/> </th>
            </tr>
        </table>
    </form>
</body>
</html>';

echo $res;

?>

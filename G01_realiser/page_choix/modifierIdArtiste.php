<?php
session_start();
require_once('../../G01_Artiste/fonctions_G01_Artiste.php');
require_once('../../etablir_connextion.php');
$res = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page D\'enregistrement</title>
</head>
<body>
    <form action="recupererIdArtiste.php" method="post">

        <h1>Renseignement d\'information</h1>

<table border="2" cellspacing="10" cellpadding="5">


          <tr>
            <th>Identifiant de l\'artiste</th>
            <th>
';

$list1 = getListIdArtiste();
$res = '<select name="id_artiste" size="10">';
foreach($list1 as $ligne) {
    foreach ($ligne as $value) {
      $artiste = getArtisteById($value);
      if($value == $_SESSION['idArtiste'])
        $res .= '<option value="' . $value . '" selected="selected">' . $artiste['artiste_nom'] . '</option>';
      else
        $res .= '<option value="' . $value . '" >' . $artiste['artiste_nom'] . '</option>';
    }
}
$res .= '</select>
            </th>
          </tr>

          <tr>
            <th><input type="submit" name="login" value="valider" /></th>
            <th><input type="reset" name="logout" value="réinitialiser" /></th>
          </tr>

        </table>

    </form>
</body>
</html>';

echo $res;

?>

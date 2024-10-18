<?php
  require_once('../G01_Artiste/fonctions_G01_Artiste.php');
  require_once('../etablir_connextion.php');
  function genererBouton(string $traitement): string {
    $res = '<form action="' . $traitement .  '" method="post">
               <input type="submit" name="login" value="Insérer un nouvel enregistrement"/> 
           </form>';
           return $res;
   }

   echo "<h1>Présentation de G01_Artiste</h1>";
   echo '<h2><a href="http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/page_accueil.html">Page' .  " d'Accueil</a></h2>";
   echo genererBouton("../G01_Artiste/page_choix/traitementInsertionArtiste.php");     
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

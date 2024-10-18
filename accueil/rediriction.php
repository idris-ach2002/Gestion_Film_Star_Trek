<?php
session_start();
switch($_SESSION["table"]) {
    case "G01_Artiste":
        header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_artiste.php');
        exit;
    case "G01_Oeuvre":
        header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_oeuvre.php');
        exit;
    case "G01_interprete":
        header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_interprete.php');
        exit;
    case "G01_realiser":
        header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/accueil_realiser.php');
        exit;
}
?>
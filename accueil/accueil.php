<?php
session_start();
if(isset($_REQUEST["login"])) {
    $_SESSION["table"] = $_POST["type"];
    header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/accueil/rediriction.php');
    exit;
}
?>
<?php
    if(isset($_REQUEST['login'])) {
        $id = $_POST['identifiant'];
        if($id == "oeuvre") {
           header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_realiser/page_choix/modifierIdOeuvre.php');
           exit;
         }else {
           header('Location: http://172.16.20.14/~ai222829/progWeb/projet_etape2/G01_realiser/page_choix/modifierIdArtiste.php');
           exit;
         }
    }
?>

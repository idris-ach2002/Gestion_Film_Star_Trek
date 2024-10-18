<?php
    require_once('information.php');
    function connexion() {
        /** TODO renseigner $strConnex à l'aide de $_ENV configuré dans monEnv.php */
        $strConnex = "host= " . $_ENV["dbHost"] . " dbname= " . $_ENV["dbName"] . " user= " . $_ENV["dbUser"] . " password=" . $_ENV["dbPasswd"];
        $ptrDB = pg_connect($strConnex);
        return $ptrDB;
    }
?>

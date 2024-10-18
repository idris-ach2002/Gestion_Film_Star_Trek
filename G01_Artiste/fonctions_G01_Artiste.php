
<?php
function getContenuArtiste() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT * FROM G01_Artiste";
        pg_prepare($ptrDb, "reqPrepSelectAll", $query);
        $ptrQuery = pg_execute($ptrDb, "reqPrepSelectAll", array());

        $res = array();

        if (isset($ptrQuery)) {
            /* TODO traitement des lignes du résultats une à une ici */
            while($ligne = pg_fetch_assoc($ptrQuery))
                array_push($res, $ligne);
        }else {
            echo 'problème de requette !<br/>';
            echo  pg_last_error($ptrDb);
            return array();
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDb);
        return $res;
    }else {
        echo 'problème de connextion !<br/>';
        return array();
    }
}

function getNomColonneArtiste() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $description = pg_meta_data($ptrDb, 'g01_artiste',false);
        $nomColonne = array();
        foreach($description as $key => $value) {
            array_push($nomColonne, $key);
        }
        pg_close($ptrDb);
        return $nomColonne;
    } else {
        echo 'problème de connextion !<br/>';
        return array();
    }
}


  function produireFormArtiste(string $val) : string{
    $res = '
        <form action="../G01_Artiste/action_G01_Artiste.php" method="post">
            <input type="hidden" name="cache" value="' . $val . '"/>
            <input type="submit" name="detail" value="Détailler"/>
            <input type="submit" name="modification" value="Modifier"/>
            <input type="submit" name="suppression" value="Supprimer"/>
        </form>';

    return $res;
  }

   function structurerContenuArtiste() : string{
    $res = "";
    $res .= '<caption>G01_Artiste</caption>';
    $table = getContenuArtiste();

    // automatiser l'obtention les noms de colonnes

    $nomColonne = getNomColonneArtiste();
    // ajout des colonnes sous forme de tableau

    $res .= '<tr>';
    foreach($nomColonne as $col) {
        $res .= "<th>$col</th>";
    }
    $res .= "<th>Action</th>";
    $res .= '</tr>';
    // ajout des enregistrements

    foreach($table as $ligne) {
        $res .= '<tr>';
        foreach($ligne as $value) {
            $res .= "<td>$value</td>";
        }
        //
        $res.= '<td>' . produireFormArtiste($ligne['artiste_id']) . '</td>';
        $res .= '</tr>';
    }
    return $res;
}



function getListIdArtiste() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT artiste_id FROM G01_Artiste";
        pg_prepare($ptrDb, "reqPrepSelectAll", $query);
        $ptrQuery = pg_execute($ptrDb, "reqPrepSelectAll", array());

        $res = array();

        if (isset($ptrQuery)) {
            /* TODO traitement des lignes du résultats une à une ici */
            while($ligne = pg_fetch_assoc($ptrQuery))
                array_push($res, $ligne);
        }else {
            echo 'problème de requette !<br/>';
            echo  pg_last_error($ptrDb);
            return array();
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDb);
        return $res;
    }else {
        echo 'problème de connextion !<br/>';
        return array();
    }
}


function getArtisteById(string $id) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM G01_Artiste WHERE artiste_id = $1";
    pg_prepare($ptrDB, "reqPrepSelectById", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectById", array($id));
    $res = array();
    if (isset($ptrQuery))
        $resu = pg_fetch_assoc($ptrQuery);
    if (empty($resu))
        $resu =  array("message" => "Identifiant de realiser non valide : ($id)");
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}


function ajouterDebutTabArtiste(array $tab, string $cle, string $val) : array {
    $res = array($cle => $val);
    foreach($tab as $k => $v)
        $res[$k] = $v;

    return $res;
}

function insertArtiste(array $artiste) : array {
    $ptrDB = connexion();

    $requette = 'INSERT INTO G01_Artiste(artiste_nom,artiste_pays,artiste_date_de_naissance) VALUES ($1,$2,$3)';

    pg_prepare($ptrDB, "requettePrepaInsert", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaInsert", array($artiste['artiste_nom'], $artiste['artiste_pays'], $artiste['artiste_date_de_naissance']));

    if($ptrQuery) {
        $requette = 'SELECT max(artiste_id) FROM G01_Artiste';
        pg_prepare($ptrDB, 'reqGetId', $requette);

        $ptrQuery = pg_execute($ptrDB, 'reqGetId', array());
        $res = pg_fetch_array($ptrQuery);
        return ajouterDebutTabArtiste($artiste,'artiste_id',$res[0]);
    }
    return array();
}


function updateArtiste(array $artiste): array  {
    $ptrDB = connexion();

    $requette = 'UPDATE G01_Artiste SET artiste_nom = $2,artiste_pays = $3,artiste_date_de_naissance = $4 WHERE artiste_id = $1';

     pg_prepare($ptrDB, "requettePrepaUpdate", $requette);
     $ptrQuery = pg_execute($ptrDB, "requettePrepaUpdate", array($artiste['artiste_id'],
     $artiste['artiste_nom'], $artiste['artiste_pays'], $artiste['artiste_date_de_naissance']));

     if($ptrQuery) {
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getArtisteById($artiste['artiste_id']);
     }
     return array();
}


function dependanceArtiste($id) : bool {
  $tab1 = getListIdInterprete();
  $tab2 = getListIdRealiser();

  foreach ($tab1 as $ligne) {
    if($ligne['artiste_id'] == $id)
        return true;
  }

  foreach ($tab2 as $ligne) {
    if($ligne['artiste_id'] == $id)
        return true;
  }
  return false;
}


function deleteArtiste(string $id): void  {
    $ptrDB = connexion();

    $requette = "DELETE FROM G01_Artiste WHERE artiste_id = $1";
    pg_prepare($ptrDB, "requettePrepaDelete", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaDelete", array($id));

    if($ptrQuery)
        echo("artiste identifiée par artiste_id = ($id) a été bien supprimée<br/>");
    else
        echo pg_last_error($ptrDB);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}
?>

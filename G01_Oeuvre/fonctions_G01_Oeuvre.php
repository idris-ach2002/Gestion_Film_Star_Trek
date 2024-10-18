<?php

function getContenuOeuvre() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT * FROM G01_Oeuvre";
        pg_prepare($ptrDb, "reqPrepSelectAll", $query);
        $ptrQuery = pg_execute($ptrDb, "reqPrepSelectAll", array());

        $res = array();

        if (isset($ptrQuery)) {
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

function getNomColonneOeuvre() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $description = pg_meta_data($ptrDb, 'g01_oeuvre',false);
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

function produireFormOeuvre(string $val) : string{
  $res = '
      <form action="../G01_Oeuvre/action_G01_Oeuvre.php" method="post">
          <input type="hidden" name="cache" value="' . $val . '"/>
          <input type="submit" name="detail" value="Détailler"/>
          <input type="submit" name="modification" value="Modifier"/>
          <input type="submit" name="suppression" value="Supprimer"/>
      </form>';

  return $res;
}


function structurerContenuOeuvre() : string{

    $res = "";
    $res .= '<caption>G01_Oeuvre</caption>';
    $table = getContenuOeuvre();

    // automatiser l'obtention les noms de colonnes

    $nomColonne = getNomColonneOeuvre();
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
        foreach($ligne as $key => $value) {
            $res .= "<td>$value</td>";
        }
        $res .= "<td>" . produireFormOeuvre($ligne['oeuvre_id']) . "</td>";
        $res .= '</tr>';
    }
    return $res;
}


function getListIdOeuvre() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT oeuvre_id FROM G01_Oeuvre";
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

function getOeuvreById(string $id) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM G01_Oeuvre WHERE oeuvre_id = $1";
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


function ajouterDebutTabOeuvre(array $tab, string $cle, string $val) : array {
    $res = array($cle => $val);
    foreach($tab as $k => $v)
        $res[$k] = $v;

    return $res;
}

function insertOeuvre(array $oeuvre) : array {
    $ptrDB = connexion();

    $requette = 'INSERT INTO G01_Oeuvre(oeuvre_nom,oeuvre_type,oeuvre_date_de_sortie) VALUES ($1,$2,$3)';

    pg_prepare($ptrDB, "requettePrepaInsert", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaInsert", array($oeuvre['oeuvre_nom'], $oeuvre['oeuvre_type'], $oeuvre['oeuvre_date_de_sortie']));

    if($ptrQuery) {
        $requette = 'SELECT max(oeuvre_id) FROM G01_Oeuvre';
        pg_prepare($ptrDB, 'reqGetId', $requette);

        $ptrQuery = pg_execute($ptrDB, 'reqGetId', array());
        $res = pg_fetch_array($ptrQuery);
        return ajouterDebutTabOeuvre($oeuvre, 'oeuvre_id', $res[0]);
    }
    return array();
}

function updateOeuvre(array $oeuvre): array  {
    $ptrDB = connexion();

    $requette = 'UPDATE G01_Oeuvre SET oeuvre_nom = $2, oeuvre_type = $3, oeuvre_date_de_sortie = $4 WHERE oeuvre_id = $1';

     pg_prepare($ptrDB, "requettePrepaUpdate", $requette);
     $ptrQuery = pg_execute($ptrDB, "requettePrepaUpdate", array($oeuvre['oeuvre_id'],$oeuvre['oeuvre_nom'], $oeuvre['oeuvre_type'], $oeuvre['oeuvre_date_de_sortie']));

     if($ptrQuery) {
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getOeuvreById($oeuvre['oeuvre_id']);
     }
     return array();
}


function dependanceOeuvre($id) : bool {
  $tab1 = getListIdInterprete();
  $tab2 = getListIdRealiser();

  foreach ($tab1 as $ligne) {
    if($ligne['oeuvre_id'] == $id)
        return true;
  }

  foreach ($tab2 as $ligne) {
    if($ligne['oeuvre_id'] == $id)
        return true;
  }
  return false;
}


function deleteOeuvre(string $id): void  {
    $ptrDB = connexion();

    $requette = "DELETE FROM G01_Oeuvre WHERE oeuvre_id = $1";
    pg_prepare($ptrDB, "requettePrepaDelete", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaDelete", array($id));

    if($ptrQuery)
        echo("Oeuvre identifiée par Oeuvre_id = ($id) a été bien supprimée<br/>");
    else
        echo pg_last_error($ptrDB);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}
?>

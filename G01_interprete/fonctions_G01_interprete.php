<?php



function getContenuInterprete() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT * FROM G01_interprete";
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

function getNomColonneInterprete() : array {
    $ptrDb = connexion();
    if($ptrDb) {
        $description = pg_meta_data($ptrDb, 'g01_interprete',false);
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


function produireFormInterprete(string $val1,string $val2) : string{
  $res = '
      <form action="../G01_interprete/action_G01_interprete.php" method="post">
          <input type="hidden" name="cache1" value="' . $val1 . '"/>
          <input type="hidden" name="cache2" value="' . $val2 . '"/>
          <input type="submit" name="detail" value="Détailler"/>
          <input type="submit" name="modification" value="Modifier"/>
          <input type="submit" name="suppression" value="Supprimer"/>
      </form>';

  return $res;
}

function structurerContenuInterprete() : string{

    $res = "";
    $res .= '<caption>G01_interprete</caption>';
    $table = getContenuInterprete();

    // automatiser l'obtention les noms de colonnes

    $nomColonne = getNomColonneInterprete();
    // ajout des colonnes sous forme de tableau

    $res .= '<tr>';
    foreach($nomColonne as $col) {
      if($col == "artiste_id")
          $res .= "<th>artiste_nom</th>";
      else if($col == "oeuvre_id")
          $res .= "<th>oeuvre_nom</th>";
      else {
        $res .= "<th>$col</th>";
      }
    }
    $res .= "<th>Action</th>";
    $res .= '</tr>';
    // ajout des enregistrements

    foreach($table as $ligne) {
        $res .= '<tr>';
        foreach($ligne as $key => $value) {
            if($key == "oeuvre_id") {
              $oeuvre = getOeuvreById($value);
              $res .= "<td>" . $oeuvre['oeuvre_nom'] . "</td>";
            }else if($key == "artiste_id") {
              $artiste = getArtisteById($value);
              $res .= "<td>" . $artiste['artiste_nom'] . "</td>";
            }else
              $res .= "<td>$value</td>";
        }
        $res .= "<td>" . produireFormInterprete($ligne['oeuvre_id'],$ligne['artiste_id']) . "</td>";
        $res .= '</tr>';
    }
    return $res;
}



function getListIdInterprete() {
  $ptrDb = connexion();
  if($ptrDb) {
      $query = "SELECT oeuvre_id,artiste_id FROM G01_interprete";
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


function insertionPossibleInterprete(array $interprete) : bool {
    $ptrDb = connexion();
    if($ptrDb) {
        $query = "SELECT COUNT(*) FROM G01_interprete WHERE oeuvre_id = $1 AND artiste_id = $2";


        pg_prepare($ptrDb, "requetteTest", $query);
        $ptrQuery = pg_execute($ptrDb,"requetteTest",$interprete);
        if($ptrQuery) {
            $ligne = pg_fetch_assoc($ptrQuery);
            foreach ($ligne as $value) {
              if($value == 1)
                return false;
            }
            pg_free_result($ptrQuery);
            pg_close($ptrDb);
            return true;
        } else {
            echo pg_last_error($ptrDb);
            return false;
        }
    } else {
        echo 'problème de connextion !<br/>';
        return false;
    }
}

function existanceIdInterprete(string $id1, string $id2) : bool { //c'est pour insertion
//sans liste de selection on regarde si les identifiant existe valeurs licites
$tab2 = getListIdArtiste();
$tab1 = getListIdOeuvre();

$control1 = false;
$control2 = false;

  foreach ($tab1 as $ligne) {
    if($ligne['oeuvre_id'] == $id1) {
        $control1 = true;
        break;
    }
  }

  foreach ($tab2 as $ligne) {
    if($ligne['artiste_id'] == $id2) {
        $control2 = true;
        break;
      }
  }
  return $control1 && $control2;
}




function getInterpreteById(string $id1,string $id2) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM G01_interprete WHERE oeuvre_id = $1 AND artiste_id = $2";
    pg_prepare($ptrDB, "reqPrepSelectById", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectById", array($id1,$id2));
    $res = array();
    if (isset($ptrQuery))
        $resu = pg_fetch_assoc($ptrQuery);
    if (empty($resu))
        $resu =  array("message" => "Identifiant de interprete non valide : ($id1,$id2)");
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}

function getListeArtisteInterprete(string $id) : array {
  $ptrDB = connexion();

  $query = "SELECT * FROM G01_interprete WHERE artiste_id = $1";
  pg_prepare($ptrDB, "reqPrepSelectByIdArtiste", $query);
  $ptrQuery = pg_execute($ptrDB, "reqPrepSelectByIdArtiste", array($id));
  $resu = array();
  if (isset($ptrQuery)) {
    while($ligne = pg_fetch_assoc($ptrQuery))
      array_push($resu,$ligne);
  }
  pg_free_result($ptrQuery);
  pg_close($ptrDB);
  return $resu;
}

function getListeOeuvreInterprete(string $id) : array {
  $ptrDB = connexion();

  $query = "SELECT * FROM G01_interprete WHERE oeuvre_id = $1";
  pg_prepare($ptrDB, "reqPrepSelectByIdOeuvre", $query);
  $ptrQuery = pg_execute($ptrDB, "reqPrepSelectByIdOeuvre", array($id));
  $resu = array();
  if (isset($ptrQuery)) {
    while($ligne = pg_fetch_assoc($ptrQuery))
      array_push($resu,$ligne);
  }
  pg_free_result($ptrQuery);
  pg_close($ptrDB);
  return $resu;
}


function insertInterprete(array $interprete) : array {
    $ptrDB = connexion();

    $requette = 'INSERT INTO G01_interprete(personnage_nom,personnageAnneDeNaissance,oeuvre_id,artiste_id) VALUES ($1,$2,$3,$4)';

    pg_prepare($ptrDB, "requettePrepaInsert", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaInsert", $interprete);

    if($ptrQuery) {
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getInterpreteById($interprete['oeuvre_id'], $interprete['artiste_id']);
    }
    return array();
}

function updateInterprete(array $interprete): array  {
    $ptrDB = connexion();

    $requette = 'UPDATE G01_interprete SET personnage_nom = $1,personnageAnneDeNaissance = $2 WHERE oeuvre_id = $3 AND artiste_id = $4';

     pg_prepare($ptrDB, "requettePrepaUpdate", $requette);
     $ptrQuery = pg_execute($ptrDB, "requettePrepaUpdate", array($interprete['personnage_nom'],
     $interprete['personnageAnneDeNaissance'], $interprete['oeuvre_id'], $interprete['artiste_id']));

     if($ptrQuery) {
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getInterpreteById($interprete['oeuvre_id'], $interprete['artiste_id']);
    }
    return array();
}

function deleteInterprete(string $id1, string $id2): void  {
    $ptrDB = connexion();

    $requette = "DELETE FROM G01_interprete WHERE oeuvre_id = $1 AND artiste_id = $2";
    pg_prepare($ptrDB, "requettePrepaDelete", $requette);
    $ptrQuery = pg_execute($ptrDB, "requettePrepaDelete", array($id1,$id2));

    if($ptrQuery)
        echo("Interprete identifiée par (oeuvre_id,artiste_id) = ($id1,$id2) a été bien supprimée<br/>");
    else
        echo pg_last_error($ptrDB);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}
?>

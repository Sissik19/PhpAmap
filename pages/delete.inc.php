<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 12/12/2017
 * Time: 12:33
 */

require_once __DIR__ . '/../classes/DB/Entities/Pain.class.php';
require_once __DIR__.'/../classes/DB/Entity.class.php';

use \DB\DbAmap ;

if ( !isset($_GET['id']) && !isset($_GET['table'])) throw new Exception("Identifiant ou table manquante") ;
$id = $_GET['id'];
$table = $_GET['table'];

$bdd = DbAmap::getCurrentInstance() ;

$stmt = $bdd->prepare('DELETE FROM '.$table.' WHERE id_'.$table.' = :id') ;

$stmt->execute(array(
    'id'=> $id,
)) ;

echo $stmt->debugDumpParams();


require __DIR__.'/../libs/http.lib.php' ;
redirect('?page='.$table.'/'.$table) ;

?>
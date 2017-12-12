<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 30/11/2017
 * Time: 12:23
 */

require_once (__DIR__ . '/../../classes/DB/Entities/Pain.class.php') ;
use DB\Pain;

$f = new Pain();


/*$v = ['id_formateur' => 4,'nom' => 'Flessel','prenom' => 'Laura'];
$f->hydrate($v);
$f->save();
//$f->delete();*/
/*
$FORMATEUR = new Formateur();
$FORMATEUR->hydrate([
    'id_formateur' => 2,
    'nom' => "PAUL",
    'prenom' => "Paolo",
]);
$FORMATEUR = Formateur::find(2);
$FORMATEUR->setNom('Test');
$FORMATEUR->setPrenom('Test');




//$FORMATEUR->save();
//$FORMATEUR->delete();


//$FORMATEUR->hydrate(array('id_formateur' => 3));
$FORMATEUR = Formateur::find(3);
//var_dump($FORMATEUR);
echo $FORMATEUR->getNom();

//$TabFormateur = Formateur::findAll();*/
$tabObject = Pain::findAll();
foreach ($tabObject as $object) {
    echo $object['type'];
}

?>
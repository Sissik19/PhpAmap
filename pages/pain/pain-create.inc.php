<?php
/**
 * @param $_GET['id'] L'ID du object à modifier
 */

//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Pain.class.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Pain;


$object = new Pain();


// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if ( isset($_POST['cereale']) && isset($_POST['prix']) && isset($_POST['poid'])) {
    $object->setCereale($_POST['cereale']);
    $object->setType($_POST['type']);
    $object->setPoid($_POST['poid']);
    $object->setPrix($_POST['prix']);
    $object->save();
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=pain/pain') ;
}


//
// VUE
//



$DOCUMENT = HtmlDocument::getCurrentInstance() ;

$DOCUMENT->addUniqueHeader('title', "<title>pain : Ajouter un pain</title>") ;

echo "<h1>Ajouter un pain</h1>\n" ;

echo "<form method='post' >\n" ;

echo "<table>\n" ;
echo "<tbody>\n" ;
echo "<tr>\n" ;
echo " <td>Cereale<td>\n" ;
echo " <td>",input_text('cereale'),"<td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Type<td>\n" ;
echo " <td>",input_text('type'),"<td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Poid<td>\n" ;
echo " <td>",input_text('poid'),"<td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Prix<td>\n" ;
echo " <td>",input_text('prix'),"<td>\n" ;
echo "</tr>\n" ;
echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<p style='text-align:center'>",input_button("Valider"),"</p>" ;

echo "</form>\n" ;

?>
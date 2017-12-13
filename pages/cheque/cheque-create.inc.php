<?php
/**
 * @param $_GET['id'] L'ID du object à modifier
 */

//
// CONTROLEUR
//


require_once __DIR__ . '/../../classes/DB/Entities/Cheque.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Cheque;


$object = new Cheque();

$tabAll = Cheque::findAll();
$size = count($tabAll);


// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if (isset($_POST['montant']) && isset($_POST['date_cheque'])) {
    $object->setIdPersonne($_POST['id_personne']);
    $object->setDateCheque($_POST['date_cheque']);
    $object->setMontant($_POST['montant']);
    $object->setNumero($_POST['numero']);
    $object->save();
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=cheque/cheque') ;
}


//
// VUE
//



$DOCUMENT = HtmlDocument::getCurrentInstance() ;

$DOCUMENT->addUniqueHeader('title', "<title>Cheque : Modifier un Cheque</title>") ;

echo "<h1>Modifier un object2</h1>\n" ;

echo "<form method='post' >\n" ;

echo "<table>\n" ;
echo "<tbody>\n" ;

echo "<tr>\n" ;
echo " <td>Personne<td>\n" ;
$tabPersonne = \DB\Personne::findAll();
echo " <td>\n";
echo"<select id='select' name='id_personne'>";
foreach ($tabPersonne as $personne){
    echo "<option value='".$personne->getIdPersonne()."'>".$personne->getNom()." ".$personne->getPrenom()."</option>";
}
echo"</select>\n";
echo"</td>\n" ;
echo "</tr>\n" ;

echo "<tr>\n" ;
echo " <td>Date<td>\n" ;
echo " <td><input type='date' name='date_cheque' required><td>\n" ;
echo "</tr>\n" ;

echo "<tr>\n" ;
echo " <td>Montant<td>\n" ;
echo " <td><input type='text' name='montant' required><td>\n" ;
echo "</tr>\n" ;

echo "<tr>\n" ;
echo " <td>Numéro de chèque<td>\n" ;
echo " <td><input type='text' name='numero' required><td>\n" ;
echo "</tr>\n" ;

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<p style='text-align:center'>",input_button("Valider"),"</p>" ;

echo "</form>\n" ;

?>
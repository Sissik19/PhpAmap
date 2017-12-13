<?php
/**
 * @param $_GET['id'] L'ID du object à modifier
 */

//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Personne;


$object = new Personne();

// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel'])) {
    $object->setNom($_POST['nom']);
    $object->setPrenom($_POST['prenom']);
    $object->setMail($_POST['mail']);
    $object->setTel($_POST['tel']);
    $object->save();
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=personne/personne') ;
}


//
// VUE
//



$DOCUMENT = HtmlDocument::getCurrentInstance() ;

$DOCUMENT->addUniqueHeader('title', "<title>personne : Ajouter un personne</title>") ;

echo "<h1>Ajouter un personne</h1>\n" ;

echo "<form method='post' >\n" ;

echo "<table>\n" ;
echo "<tbody>\n" ;
echo "<tr>\n" ;
echo " <td>Nom<td>\n" ;
echo " <td><input type='text' name='nom' required><td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Prenom<td>\n" ;
echo " <td><input type='text' name='prenom' required><td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Email<td>\n" ;
echo " <td><input type='mail' name='mail'><td>\n" ;
echo "</tr>\n" ;
echo "<tr>\n" ;
echo " <td>Tel<td>\n" ;
echo " <td><input type='text' name='tel' required><td>\n" ;
echo "</tr>\n" ;
echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<p style='text-align:center'>",input_button("Valider"),"</p>" ;

echo "</form>\n" ;

?>
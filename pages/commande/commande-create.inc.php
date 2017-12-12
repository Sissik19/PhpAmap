<?php
/**
 * @param $_GET['id'] L'ID du object à modifier
 */

//
// CONTROLEUR
//


require_once __DIR__ . '/../../classes/DB/Entities/Commande.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Etat.class.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Commande;


$object = new Commande();

$tabAll = Commande::findAll();
$size = count($tabAll);


// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if (isset($_POST['prix_total']) && isset($_POST['date_commande'])) {
    $object->setIdPersonne($_POST['id_personne']);
    $object->setIdEtat($_POST['id_personne']);
    $object->setDateCommande($_POST['date_commande']);
    $object->setPrixTotal($_POST['prix_total']);
    $object->save();
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=Commande/Commande') ;
}


//
// VUE
//



$DOCUMENT = HtmlDocument::getCurrentInstance() ;

$DOCUMENT->addUniqueHeader('title', "<title>Commande : Modifier un Commande</title>") ;

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
echo " <td>Etat<td>\n" ;
$tabEtat = \DB\Etat::findAll();
echo " <td>\n";
echo"<select id='select' name='id_etat'>";
foreach ($tabEtat as $etat){
    echo "<option value='".$etat['id_etat']."'>".$etat['etat']."</option>";
}
echo"</select>\n";
echo"</td>\n" ;
echo "</tr>\n" ;

echo "<tr>\n" ;
echo " <td>Date<td>\n" ;
echo " <td><input type='date' name='date_commande'<td>\n" ;
echo "</tr>\n" ;

echo "<tr>\n" ;
echo " <td>Montant<td>\n" ;
echo " <td>",input_text('prix_total'),"<td>\n" ;
echo "</tr>\n" ;

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<p style='text-align:center'>",input_button("Valider"),"</p>" ;

echo "</form>\n" ;

?>
<?php
/**
 * @param $_GET['id'] L'ID du object à modifier
 */

//
// CONTROLEUR
//

if ( !isset($_GET['id']) ) throw new Exception("Identifiant de object manquant") ;

require_once __DIR__ . '/../../classes/DB/Entities/Cheque.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Cheque;


$object = Cheque::find($_GET['id']);

// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if (isset($_POST['montant']) && isset($_POST['date_cheque'])) {
    echo $_POST['id_personne'];
    $object->setIdPersonne($_POST['id_personne']);
    $object->setDateCheque($_POST['date_cheque']);
    $object->setMontant($_POST['montant']);
    $object->save();
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=Cheque/Cheque') ;
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
                            echo "<option value='".$personne['id_personne']."'>".$personne['nom']." ".$personne['prenom']."</option>";
                        }
                echo"</select>\n";
            echo"</td>\n" ;
        echo "</tr>\n" ;

        echo "<tr>\n" ;
            echo " <td>Type<td>\n" ;
            echo " <td>",input_text('date_cheque', $object->getDateCheque()),"<td>\n" ;
        echo "</tr>\n" ;

        echo "<tr>\n" ;
            echo " <td>Poid<td>\n" ;
            echo " <td>",input_text('montant', $object->getMontant()),"<td>\n" ;
        echo "</tr>\n" ;

    echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<p style='text-align:center'>",input_button("Valider"),"</p>" ;

echo "</form>\n" ;

?>
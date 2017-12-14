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
require_once __DIR__ . '/../../classes/DB/Entities/Pain.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/List_Pain.php';
require_once __DIR__.'/../../classes/DB/Entity.class.php';
require_once __DIR__.'/../../libs/html.lib.php' ;

use \DB\Commande;


$tabAll = Commande::findAll();
$size = count($tabAll);
$tabPersonne = \DB\Personne::findAll();
$tabPain = \DB\Pain::findAll();


// Si il y a des données POST, on modifie l'objet en base et on redirige vers la page "liste objects"
if (isset($_POST['sub'])) {
    foreach ($tabPersonne as $personne){
        foreach ($tabPain as $pain){
            $objectCommande = new Commande();
            $objectList = new \DB\List_Pain();
            echo $_POST[$personne->getIdPersonne()."-".$pain['id_pain']];
            if(($_POST[$personne->getIdPersonne()."-".$pain['id_pain']])!=0) {
                $objectCommande->setDateCommande($_POST['date']);
                $objectCommande->setIdPersonne($personne->getIdPersonne());
                $objectCommande->setIdEtat(1);
                $objectCommande->save();

                $objectList->setIdPain($pain['id_pain']);
                $objectList->setIdCommande($objectCommande->getIdCommande());
                $objectList->save();
            }
        }
    }
    require __DIR__.'/../../libs/http.lib.php' ;
    redirect('?page=commande/Commande') ;
}


//
// VUE
//



$DOCUMENT = HtmlDocument::getCurrentInstance() ;

$DOCUMENT->addUniqueHeader('title', "<title>Commande : Modifier un Commande</title>") ;

echo "<h1>Passer la commande de la semaine</h1>\n" ;

echo "<form method='post'>\n" ;

echo "<table>\n" ;
echo "<tbody>\n" ;

echo "<tr>\n" ;
    echo "<td colspan='2' rowspan='2'>Date <input type='date' name='date' required></td>";
    foreach ($tabPain as $pain){
        echo "<th>".$pain['cereale']."</th>";
    }
echo "</tr>";
echo "<tr>\n" ;
    foreach ($tabPain as $pain){
        echo "<th>".$pain['type']."</th>";
    }
echo "</tr>";
echo "<tr>\n" ;
    echo "<th>Nom</th>";
    echo "<th>Prenom</th>";
    foreach ($tabPain as $pain){
        echo "<th>".$pain['poid']."kg</th>";
    }
echo "</tr>";

    foreach ($tabPersonne as $personne){
        echo "<tr>\n" ;
        echo "<td>".$personne->getNom()."</td>";
        echo "<td>".$personne->getPrenom()."</td>";
        foreach ($tabPain as $item) {
            echo "<td><input class='number' min='0' type='number' value='0' name='".$personne->getIdPersonne()."-".$item['id_pain']."'></td>";
        }
        echo "</tr>";
    }




echo "</tr>";

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<input type='submit' value='Valider' name='sub'>" ;

echo "</form>\n" ;

?>
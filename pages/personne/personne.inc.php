<?php
//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Commande.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Cheque.class.php';

use \DB\Personne ;

$tabObject = Personne::findAll();
$table = "personne";

$tabCommande = \DB\Commande::findAll();
$tabPersonne = Personne::findAll();
$tabCheque = \DB\Cheque::findAll();


foreach ($tabPersonne as $personne){
    $valeur = 0;
    foreach ($tabCommande as $commande){
        if($commande['id_personne']===$personne->getIdPersonne()){
            $valeur = $valeur-$commande['prix_total'];
        }
    }
    foreach ($tabCheque as $cheque){
        if($cheque['id_personne']===$personne->getIdPersonne()){
            $valeur = $valeur+$cheque['montant'];
        }
    }

    $personne->setCompte($valeur);
    $personne->save();
}




//
// VUE
//

require_once __DIR__ . '/../../libs/html.lib.php';

$doc = HtmlDocument::getCurrentInstance() ;
$doc->addUniqueHeader('title', "<title>personne</title>") ;

echo "<h1>Liste des clients</h1>\n" ;
echo "<input type='button' onclick='window.location.reload(false)' value='Rafraichir'/>";

echo "<table>\n" ;
echo "<thead>\n" ;
echo "<tr>\n" ;
echo " <th>Nom</th>\n" ;
echo " <th>Prenom</th>\n" ;
echo " <th>Adresse mail</th>\n" ;
echo " <th>Téléphone</th>\n" ;
echo " <th>Compte (en €)</th>\n" ;
echo " <th>Commandes</th>\n" ;
echo " <th>Cheques</th>\n" ;
echo " <th></th>\n" ;
echo "</tr>\n" ;
echo "</thead>\n" ;
echo "<tbody>\n" ;
foreach ($tabObject as $object) {
    echo "<tr>\n" ;
    echo " <td>",htmlspecialchars($object->getNom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object->getPrenom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object->getMail()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object->getTel()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object->getCompte()),"</td>\n" ;
    echo "<td><a href='?page=pain/pain'><button>X</button></a></td>";
    echo "<td><a href='?page=pain/pain'><button>X</button></a></td>";
    echo "<td><a href='?page=personne/personne-modifier&id=".$object->getIdPersonne()."'><button>modifier</button></a></td>\n" ;
    echo "<td><a href='?page=delete&id=".$object->getIdPersonne()."&table=".$table."'><button>supprimer</button></a></td>\n";
    echo "</tr>\n" ;
}

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<a href='?page=personne/personne-create'><button>Ajouter nouveau</button></a>";

?>
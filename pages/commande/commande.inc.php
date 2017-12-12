<?php
//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Commande.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Etat.class.php';

use \DB\Commande ;

$tabObject = Commande::findAll();
$table = "commande";
//
// VUE
//

require_once __DIR__ . '/../../libs/html.lib.php';

$doc = HtmlDocument::getCurrentInstance() ;
$doc->addUniqueHeader('title', "<title>commande</title>") ;

echo "<h1>Liste des commandes</h1>\n" ;

echo "<table>\n" ;
echo "<thead>\n" ;
echo "<tr>\n" ;
echo " <th>Nom</th>\n" ;
echo " <th>Prenom</th>\n" ;
echo " <th>Date</th>\n" ;
echo " <th>Montant (en €)</th>\n" ;
echo " <th>Etat</th>\n" ;
echo " <th></th>\n" ;
echo "</tr>\n" ;
echo "</thead>\n" ;
echo "<tbody>\n" ;
foreach ($tabObject as $object) {
    echo "<tr>\n" ;

    $personne = \DB\Personne::find($object['id_personne']);
    $etat = \DB\Etat::find($object['id_etat']);

    echo " <td>",htmlspecialchars($personne->getNom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($personne->getPrenom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['date_commande']),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['prix_total']),"</td>\n" ;
    echo " <td>",htmlspecialchars($etat->getEtat()),"</td>\n" ;
    echo "<td><a href='?page=commande/commande-modifier&id=".$object['id_commande']."'><button>modifier</button></a></td>\n" ;
    echo "<td><a href='?page=delete&id=".$object['id_commande']."&table=".$table."'><button>supprimer</button></a></td>\n";
    echo "</tr>\n" ;
}

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<a href='?page=commande/commande-create'><button>Ajouter nouveau</button></a>";

?>
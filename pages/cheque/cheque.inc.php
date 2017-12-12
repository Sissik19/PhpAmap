<?php
//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Cheque.class.php';
require_once __DIR__ . '/../../classes/DB/Entities/Personne.class.php';

use \DB\Cheque ;

$tabObject = Cheque::findAll();
$table = "cheque";
//
// VUE
//

require_once __DIR__ . '/../../libs/html.lib.php';

$doc = HtmlDocument::getCurrentInstance() ;
$doc->addUniqueHeader('title', "<title>cheque</title>") ;

echo "<h1>Liste des chèques</h1>\n" ;

echo "<table>\n" ;
echo "<thead>\n" ;
echo "<tr>\n" ;
echo " <th>Nom</th>\n" ;
echo " <th>Prenom</th>\n" ;
echo " <th>Date</th>\n" ;
echo " <th>Montant (en €)</th>\n" ;
echo " <th></th>\n" ;
echo "</tr>\n" ;
echo "</thead>\n" ;
echo "<tbody>\n" ;
foreach ($tabObject as $object) {
    echo "<tr>\n" ;

    $personne = \DB\Personne::find($object['id_personne']);

    echo " <td>",htmlspecialchars($personne->getNom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($personne->getPrenom()),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['date_cheque']),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['montant']),"</td>\n" ;
    echo "<td><a href='?page=cheque/cheque-modifier&id=".$object['id_cheque']."'><button>modifier</button></a></td>\n" ;
    echo "<td><a href='?page=delete&id=".$object['id_cheque']."&table=".$table."'><button>supprimer</button></a></td>\n";
    echo "</tr>\n" ;
}

echo "</tbody>\n" ;
echo "</table>\n" ;

echo "<a href='?page=cheque/cheque-create'><button>Ajouter nouveau</button></a>";

?>
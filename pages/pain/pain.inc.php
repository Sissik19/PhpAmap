<?php
//
// CONTROLEUR
//

require_once __DIR__ . '/../../classes/DB/Entities/Pain.class.php';

use \DB\Pain ;

$tabObject = Pain::findAll();
$table = "pain";

//
// VUE
//

require_once __DIR__ . '/../../libs/html.lib.php';

$doc = HtmlDocument::getCurrentInstance() ;
$doc->addUniqueHeader('title', "<title>Pains</title>") ;

echo "<h1>Liste des pains</h1>\n" ;

echo "<table>\n" ;
echo "<thead>\n" ;
echo "<tr>\n" ;
echo " <th>Cereale</th>\n" ;
echo " <th>Type</th>\n" ;
echo " <th>Poid (en kg)</th>\n" ;
echo " <th>Prix (en €)</th>\n" ;
echo " <th></th>\n" ;
echo " <th></th>\n" ;
echo "</tr>\n" ;
echo "</thead>\n" ;
echo "<tbody>\n" ;
foreach ($tabObject as $object) {
    echo "<tr>\n" ;
    echo " <td>",htmlspecialchars($object['cereale']),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['type']),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['poid']),"</td>\n" ;
    echo " <td>",htmlspecialchars($object['prix']),"</td>\n" ;
    echo "<td><a href='?page=pain/pain-modifier&id=".$object['id_pain']."'><button>modifier</button></a></td>\n" ;
    echo "<td><a href='?page=delete&id=".$object['id_pain']."&table=".$table."'><button>supprimer</button></a></td>\n";
    echo "</tr>\n" ;
}
echo "</tbody>\n" ;
echo "</table>\n" ;
echo "<a href='?page=pain/pain-create'><button>Ajouter nouveau</button></a>";

?>
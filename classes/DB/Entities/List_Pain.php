<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 12/12/2017
 * Time: 16:14
 */

namespace DB;
require_once (__DIR__."/../Entity.class.php") ;

class List_Pain extends Entity{

    const TABLE = 'list_pain';
    const PRIMARYKEY = 'id_list_pain';

    public function __construct()
    {
        parent::__construct(self::TABLE, self::PRIMARYKEY);
    }



    public static function find($id){
        try {
            $bdd = DbAmap::getCurrentInstance();
        }
        catch (\PDOException $e){
            die("Échec lors de la connexion : ".$e->getMessage()) ;
        }
        $sth = $bdd->prepare("SELECT * FROM ".self::TABLE." WHERE ".self::PRIMARYKEY." = ".$id);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        $objet=new List_Pain();
        $objet->hydrate([
            self::PRIMARYKEY => $id,
            'id_pain' => $result['prix_total'],
            'id_commande' => $result['id_commande'],
        ]);
        return $objet;
    }

    public static function findAll(){
        try {
            $bdd = DbAmap::getCurrentInstance();
        }
        catch (\PDOException $e){
            die("Échec lors de la connexion : ".$e->getMessage()) ;
        }
        $sth = $bdd->prepare("SELECT * FROM ".self::TABLE);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}

?>

<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 08/12/2017
 * Time: 11:58
 */



namespace DB;
require_once (__DIR__."/../Entity.class.php") ;


class Pain extends Entity {
    const TABLE = 'pain';
    const PRIMARYKEY = 'id_pain';

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
        $objet=new Pain();
        $objet->hydrate([
            self::PRIMARYKEY => $id,
            'cereale' => $result['cereale'],
            'type' => $result['type'],
            'poid' => $result['poid'],
            'prix' => $result['prix'],
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
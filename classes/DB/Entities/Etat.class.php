<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 12/12/2017
 * Time: 16:14
 */

namespace DB;
require_once (__DIR__."/../Entity.class.php") ;

class Etat extends Entity{

    const TABLE = 'etat';
    const PRIMARYKEY = 'id_etat';

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
        $objet=new Etat();
        $objet->hydrate([
            self::PRIMARYKEY => $id,
            'etat' => $result['etat'],
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

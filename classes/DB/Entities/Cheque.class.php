<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 08/12/2017
 * Time: 11:58
 */



namespace DB;
require_once (__DIR__."/../Entity.class.php") ;


class Cheque extends Entity {
    const TABLE = 'cheque';
    const PRIMARYKEY = 'id_cheque';

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
        $objet=new Cheque();
        $objet->hydrate([
            self::PRIMARYKEY => $id,
            'id_personne' => $result['id_personne'],
            'date_cheque' => $result['date_cheque'],
            'montant' => $result['montant'],
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
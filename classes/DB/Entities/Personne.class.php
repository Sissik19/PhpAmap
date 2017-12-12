<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 12/12/2017
 * Time: 11:56
 */

namespace DB;
require_once (__DIR__."/../Entity.class.php") ;

class Personne extends Entity{
    const TABLE = 'personne';
    const PRIMARYKEY = 'id_personne';

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
        $objet=new Personne();
        $objet->hydrate([
            self::PRIMARYKEY => $id,
            'nom' => $result['nom'],
            'prenom' => $result['prenom'],
            'mail' => $result['mail'],
            'tel' => $result['tel'],
            'compte' => $result['compte'],
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
        foreach ($result as $value) {
            $object = new Personne();
            $object->hydrate([
                'id_personne' => $value['id_personne'],
                'nom' => $value['nom'],
                'prenom' => $value['prenom'],
                'mail' => $value['mail'],
                'tel' => $value['tel'],
                'compte' => $value['compte'],
            ]);
            $return[] = $object;
        }
        return $return;
    }
}
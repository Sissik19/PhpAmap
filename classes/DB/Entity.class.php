<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 30/11/2017
 * Time: 11:47
 */
namespace DB;

require (__DIR__ . "/DbAmap.class.php");


class Entity{
    private $tableName; //String
    private $pkName; //nom clé primaire (id formateur,..)
    private $values; //tab assiociatif retourner par le fetch

    public static function underscore($string){
            $string = preg_replace("/[A-Z]/","_$0", $string);
            $string = strtolower($string);
            $string= substr($string, 1);
        return $string;
    }

    public function __construct($tableName, $idFieldName){
        $this->tableName = $tableName;
        $this->pkName = $idFieldName;
    }
    //hydrate = select * pour remplir values
    public function hydrate($values){
        $this->values = $values;
    }

    public function __call($method, $params){
        if(preg_match("/^set/i", $method)){
            //substring possible
            $method = preg_replace("/^set/i","", $method);
            $this->values[self::underscore($method)] = $params[0];
        }
        else if(preg_match("/^get/i", $method)){
            $method = preg_replace("/^get/i","",$method);
            return $this->values[self::underscore($method)];
        }
        else{
            throw new \Exception("Methode impossible : fonction non traitée");
        }
    }

    //save : insert + update
    public function save(){
        $bdd = DbAmap::getCurrentInstance();

        $length = count($this->values); //Nombres de colonnes de la table
        $update = ""; //Tout ce qui suit UPDATE dans la requête
        for($i=1; $i < $length; $i ++){
            $update = $update.array_keys($this->values)[$i]."=:".array_keys($this->values)[$i];
            if(($length - $i) != 1){
                $update = $update.", ";
            }
        }

        $stmt = $bdd->prepare('INSERT INTO '.$this->tableName.' ('.implode(", ",array_keys($this->values)).') VALUES (:'.implode(", :",array_keys($this->values)).') ON DUPLICATE KEY UPDATE '.$update);

        $array = [];
        for($i=0; $i < $length; $i ++){
            $array[array_keys($this->values)[$i]] = array_values($this->values)[$i];
        }

        $stmt->execute($array);

        DbAmap::close() ;
    }

    //delete : delete
    public function delete(){
        $bdd = DbAmap::getCurrentInstance() ;

        $stmt = $bdd->prepare('DELETE FROM '.$this->tableName.' WHERE '.$this->pkName.' = :id');
        $stmt->execute(array('id' => array_values($this->values)[0]));
        // $stmt->execute(array('id' => $param));

        DbAmap::close() ;

        // echo 'DELETE FROM '.$this->tableName.' WHERE '.$this->pkName.' = :id';
    }
}
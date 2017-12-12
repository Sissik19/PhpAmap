<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 24/11/2017
 * Time: 10:56
 */
namespace DB;
use \PDO;

class DbAmap extends PDO
{
    const USER = 'root';
    const MDP = '';
    const CONNECTION = 'localhost';
    const BDD = 'amapdata';
    private static $currentInstance;

    public function __construct()
    {
        parent::__construct('mysql:host='.self::CONNECTION.';dbname='.self::BDD, self::USER, self::MDP);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getCurrentInstance(){
        if(self::$currentInstance === null){
           self::$currentInstance = new DbAmap();
        }
        return self::$currentInstance;
    }

    public static function close(){
        self::$currentInstance = null;
    }
}
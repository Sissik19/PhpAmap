<?php
/**
 * Created by PhpStorm.
 * User: Camille K
 * Date: 24/11/2017
 * Time: 10:39
 */

class PageInexistanteException extends Exception
{
    public function __construct($message)
    {
        if($message==null) {
            parent::__construct("Page inexistante");
        }
        else{
            parent::__construct($message);
        }
    }
}
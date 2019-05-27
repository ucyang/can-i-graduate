<?php
//include "./classes/context/Context.class.php";
/**
 * Manages view of MVC framework
 */
class View
{
    static public $view = NULL;


    public static function init()
    {

    }
    public static function displayContent()
    {
        require $_SERVER['DOCUMENT_ROOT']."/pages/".Context::$act.".php";
    }
    public static function close()
    {

    }


}

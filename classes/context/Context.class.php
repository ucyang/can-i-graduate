<?php
/**
 * Manages context such as request arguments/environment variables
 */
class Context
{
    public static $isLogged = false;
    public static $act;

    public static function init()
    {
        // Load DB configuration.
        DB::init();
        // Parse URL.
        self::parseUrl();
        // Start session
        session_start();
        // Start output buffer
        ob_start();
    }

    public static function close()
    {
        session_write_close();
        ob_end_flush();
        DB::close();
    }

    public static function parseUrl(){
      if(!isset($_GET['act'])){
        Context::$act = 'login';
      }else{
        Context::$act = $_GET['act'];
      }
    }
}

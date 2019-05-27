<?php
/**
 * Manages context such as request arguments/environment variables
 */
class Context
{
    public static $DBInfo = NULL;
    public static $isLogged = false;
    protected static $DBFilename = 'config/db.config.php';

    public static function init()
    {
        // Load DB configuration.
        self::loadDBInfo();
        // Start session
        session_start();
        // Start output buffer
        ob_start();
    }

    public static function loadDBInfo()
    {
        /**
         * @brief Include basic configuration file
        **/
        if (file_exists(CIG_BASEDIR . self::$DBFilename))
        {
            ob_start();
            self::$DBInfo = require CIG_BASEDIR . self::$DBFilename;
            ob_end_clean();
        }
    }

    public static function close()
    {
        session_write_close();
        ob_end_flush();
    }
}

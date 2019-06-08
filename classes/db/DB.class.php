<?php
/**
 * Manages database
 */
class DB
{
    //db 정보
    public static $DBInfo = NULL;
    protected static $DBFilename = 'config/db.config.php';
    //db 연결 변수
    protected static $conn;

    public static function init()
    {
      // Load DB configuration.
      self::loadDBInfo();
      // Connect DB.
      self::connectDB();
    }

    public static function close()
    {
      // Disconnect DB.
      self::disconnectDB();
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

    public static function connectDB()
    {
    
      self::$conn = new mysqli(self::$DBInfo['db_hostname'],self::$DBInfo['db_userid'],self::$DBInfo['db_password'],self::$DBInfo['db_database']);
      if(self::$conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
      }
    }

    public static function disconnectDB()
    {
      self::$conn->close();
    }

    public static function getConn()
    {
      if(!self::$conn){
        echo '에러발생'. self::$conn->error;
      }else{

        return self::$conn;
      }
    }
}

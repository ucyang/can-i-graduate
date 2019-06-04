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
    protected static $stmt;

    public static function init()
    {
      // Load DB configuration.
      self::loadDBInfo();
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

    public static function connectDB(){
      //후에 context 안에 들어가 있는 정보로 대체
      self::$conn = new mysqli(self::$DBInfo['db_hostname'],self::$DBInfo['db_userid'],self::$DBInfo['db_password'],self::$DBInfo['db_database']);
      if(self::$conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
      }
    }

    //insert를 한다.
    //매개변수 1: table 이름, 매개변수 2: 넣을 것들을 연관배열로 받는다.
    //ex) $values['id'] = 'aaa'
    public static function insert($table, $values){
      $sql = "INSERT INTO $table"."(";
      end($values); $last_key = key($values);
      foreach ($values as $key=>$value) {
        $sql = $sql.$key;
        if( $key != $last_key ) $sql = $sql .', ';
      }
      $sql = $sql.") VALUES (";
      end($values); $last_key = key($values);
      foreach ($values as $key=>$value) {
        if(!is_numeric($value)){
          $sql = $sql."'".$value."'";
        }else{
          $sql = $sql.$value;
        }

        if( $key != $last_key ) $sql = $sql .', ';
      }
      $sql = $sql.")";

      if (self::$conn->query($sql) === TRUE) {
        echo "insert successfully";
      } else {
        echo "Error: " . $sql . "<br>" . self::$conn->error;
      }
    }

    public static function insertPrepare($table, $values){
      $sql = "INSERT INTO $table"."(";
      end($values); $last_key = key($values);
      foreach ($values as $key=>$value) {
        $sql = $sql.$key;
        if( $key != $last_key ) $sql = $sql .', ';
      }
      $sql = $sql.") VALUES (";
      end($values); $last_key = key($values);
      foreach ($values as $key=>$value) {

        $sql = $sql."?";

        if( $key != $last_key ) $sql = $sql .', ';
      }
      $sql = $sql.")";
      self::$stmt =self::$conn->prepare($sql);
      if(self::$stmt==false){
        die('prepare() failed: ' . htmlspecialchars(self::$conn->error));
      }else{
        echo "prepare 성공";
      }
    }
    //select를 한다.
    //매개변수 1: table이름, 매개변수 2: 불러올 열들 ,매개변수 3: 조건들
    public static function select($table, $cols, $conditions){
      $arr = array();
      $sql = "SELECT ";
      if(count($cols) == 1){
        $sql = $sql." ".$cols;
      }else{
        foreach($cols as $key=>$value){
          $sql = $sql.$value;
        }
      }

      $sql = $sql." FROM $table WHERE";
      foreach($conditions as $key=>$value){
        $sql = $sql." $key=$value ";
      }
      $result=self::$conn->query($sql);
      if ($result == TRUE) {
        echo "select successfully<br>";
      } else {
        echo "Error: " . $sql . "<br>" . self::$conn->error;
      }

      while($row = $result->fetch_assoc()){
        array_push($arr,$row);
      }
      return $arr;
    }
    public static function bindParam($arr){

      call_user_func_array(array(self::$stmt, 'bind_param'), $arr);
      //echo self::$stmt->error;
    }
    public static function execute(){
      self::$stmt->execute();

      //echo self::$stmt->error;
    }
}

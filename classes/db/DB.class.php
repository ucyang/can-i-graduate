<?php
/**
 * Manages database
 */
class DB
{
    static public $db = NULL;

    //db 정보
    private static $db_info=[
      'host' => '127.0.0.1',
      'id' => 'cig_admin',
      'password'=> '1',
      'dbName'=>'can_i_graduate'
    ];
    //db 연결 변수
    static $conn;
    static $stmt;


    public static function connectDB(){
      //후에 context 안에 들어가 있는 정보로 대체
      DB::$conn = new mysqli(DB::$db_info['host'],DB::$db_info['id'],DB::$db_info['password'],DB::$db_info['dbName']);
      if(DB::$conn->connect_error){
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

      if (DB::$conn->query($sql) === TRUE) {
        echo "insert successfully";
      } else {
        echo "Error: " . $sql . "<br>" . DB::$conn->error;
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
      DB::$stmt =DB::$conn->prepare($sql);
      if(DB::$stmt==false){
        die('prepare() failed: ' . htmlspecialchars(DB::$conn->error));
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
      $result=DB::$conn->query($sql);
      if ($result == TRUE) {
        echo "select successfully<br>";
      } else {
        echo "Error: " . $sql . "<br>" . DB::$conn->error;
      }

      while($row = $result->fetch_assoc()){
        array_push($arr,$row);
      }
      return $arr;
    }
    public static function bindParam($arr){

      call_user_func_array(array(DB::$stmt, 'bind_param'), $arr);
      //echo DB::$stmt->error;
    }
    public static function execute(){
      DB::$stmt->execute();

      //echo DB::$stmt->error;
    }
}

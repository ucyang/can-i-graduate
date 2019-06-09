<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * Manages users
 */
class User
{


    public static $major_srl;
    public static $admission_year;
    public static $campus;

    public static $gpa; //학점
    public static $gpa_major;//전공 학점

    public static $graduationStatus; //졸업요건 연관배열(english, korean_history,chinese_char,paper,counseling,portfolio,coding_boot_camp,topcit,open_source)



    public static $attended_lectures;

    /*
    전공, 입학년도, 캠퍼스 정보를 가져와서 저장
    */
    public static function init(){
      $sql ="SELECT major_srl, admission_year, campus FROM members WHERE member_srl = {$_SESSION['user_srl']}";
      $data= DB::getConn()->query($sql);
      if($data)
      {

        $userInfo = $data->fetch_assoc();
      }
      else
      {

        echo "Error: ".DB::getConn()->error;
      }
      self::$admission_year = $userInfo['admission_year'];
      self::$major_srl = $userInfo['major_srl'];
      self::$campus = $userInfo['campus'];
    }

    //public static function get

    /*
    attended_lectures에서 수강한 과목들을 가져온다.
    */
    public static function getattendedLectures()
    {
        $sql ="SELECT attended_lectures.lecture_srl, attended_lectures.grade, lectures.course_no, lectures.title, lectures.college, lectures.dept, lectures.course_type, lectures.abeek_type
        FROM attended_lectures INNER JOIN lectures USING(lecture_srl) WHERE member_srl= {$_SESSION['user_srl']}";

        $data= DB::getConn()->query($sql);
        if($data)
        {
          self::$attended_lectures =$data->fetch_all(MYSQLI_ASSOC);
        }
        else
        {
          echo "Error: ".DB::getConn()->error;
        }
    }
}

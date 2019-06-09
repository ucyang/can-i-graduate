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

    public static $credit; //수강 학점

    public static $gpa; //학점
    public static $gpa_major;//전공 학점

    public static $graduationStatus; //졸업요건 연관배열(english, korean_history,chinese_char,paper,counseling,portfolio,coding_boot_camp,topcit,open_source)

    public static $commonLecture;//공통교양
    public static $majorEssential;//공통교양

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

      self::$credit= array("general"=>0,"major"=>0,"free"=>0,"BSM"=>0,"design"=>0,"professional"=>0,"total"=>0);
      self::$commonLecture= array("creative"=>"N","Accounting"=>"N","korean_history"=>"N","ACT"=>"N","design"=>"N","English"=>"N", "writing"=>"N");
      self::$majorEssential= array("creativeDesign"=>"N","discreteMath"=>"N","dataStructure"=>"N","programingLanguage"=>"N","cumputerArchitecture"=>"N","Algorithm"=>"N", "os"=>"N","SE"=>"N","c1"=>"N","c2"=>"N","internship"=>"N");
      self::$gpa = 0;
    }

    public static function getGraduationStatus()
    {

      for($j = 0; $j<count(self::$attended_lectures);$j++){

  		  if(preg_match('/(자유선택)/',self::$attended_lectures[$j]['course_class'])){

  			  self::$credit['free'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(교양)/',self::$attended_lectures[$j]['course_class'])){

  			  self::$credit['general'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(전공)/',self::$attended_lectures[$j]['course_class'])){

  			  self::$credit['major'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(BSM)/',self::$attended_lectures[$j]['abeek_type'])){

  			  self::$credit['BSM'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(설계)/',self::$attended_lectures[$j]['abeek_type'])){
  			  self::$credit['design'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(앙트레프레너십시대의회계)/',self::$attended_lectures[$j]['title'])){
          self::$commonLecture['Accounting'] = "Y";
        }
        if(preg_match('/(창의와소통)/',self::$attended_lectures[$j]['title'])){
          self::$commonLecture['creative'] = "Y";
        }
        if(preg_match('/(한국사)/',self::$attended_lectures[$j]['title'])){

          self::$commonLecture['korean_history'] = "Y";
        }
        if(preg_match('/(글쓰기)/',self::$attended_lectures[$j]['title'])){

          self::$commonLecture['writing'] = "Y";
        }
        if(preg_match('/(ACT)/',self::$attended_lectures[$j]['title'])){
          self::$commonLecture['ACT'] = "Y";
        }
        if(preg_match('/(Communication in English)/',self::$attended_lectures[$j]['title'])){
          self::$commonLecture['English'] = "Y";
        }
        if(preg_match('/(디자인적사고와문제해결)/',self::$attended_lectures[$j]['title'])){
          self::$commonLecture['design'] = "Y";
        }

        if(preg_match('/(창의적설계)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['creativeDesign'] = "Y";
        }
        if(preg_match('/(이산수학)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['discreteMath'] = "Y";
        }
        if(preg_match('/(자료구조)/',self::$attended_lectures[$j]['title'])){

          self::$majorEssential['dataStructure'] = "Y";
        }
        if(preg_match('/(프로그래밍언어론)/',self::$attended_lectures[$j]['title'])){

          self::$majorEssential['programingLanguage'] = "Y";
        }
        if(preg_match('/(컴퓨터구조)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['cumputerArchitecture'] = "Y";
        }
        if(preg_match('/(알고리즘)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['Algorithm'] = "Y";
        }
        if(preg_match('/(운영체제)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['os'] = "Y";
        }
        if(preg_match('/(휴먼 ICT 소프트웨어공학)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['SE'] = "Y";
        }
        if(preg_match('/(캡스톤디자인\(1\))/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['c1'] = "Y";
        }
        if(preg_match('/(캡스톤디자인\(2\))/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['c2'] = "Y";
        }
        if(preg_match('/(인턴)/',self::$attended_lectures[$j]['title'])){
          self::$majorEssential['internship'] = "Y";
        }
        if(preg_match('/(앙트레프레너십시대의회계)|(글쓰기)|(한국사)|(문학과예술의사회사)|(창의융합과미래설계)|(4차산업현장맞춤형프로젝트Ⅱ)/',self::$attended_lectures[$j]['title']))
  		  {
          echo "전문교양<br>".self::$attended_lectures[$j]['credit'];
  			  self::$credit['professional'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  self::$gpa += (int)self::$attended_lectures[$j]['grade'] * (int)self::$attended_lectures[$j]['credit'];

  	  }
      self::$credit['total'] = (int)self::$credit['general'] + (int)self::$credit['free'] +(int)self::$credit['major'];
      //self::$gpa /= self::$credit['total'];

    }

    /*
    attended_lectures에서 수강한 과목들을 가져온다.
    */
    public static function getattendedLectures()
    {
        $sql ="SELECT attended_lectures.lecture_srl, attended_lectures.grade, lectures.course_no, lectures.course_class,lectures.title, lectures.credit,lectures.college, lectures.dept, lectures.course_type, lectures.abeek_type
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

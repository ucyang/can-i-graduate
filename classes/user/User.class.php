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
    public static $member_srl;

    public static $credit; //수강 학점

    public static $gpa; //학점
    public static $gpa_major;//전공 학점

    public static $graduationStatus; //졸업요건 연관배열(english,chinese_char,paper,counseling,portfolio,coding_boot_camp,topcit,open_source)

    public static $commonLecture;//공통교양
    public static $majorEssential;//전공필수

    public static $attended_lectures;

    /*
    전공, 입학년도, 캠퍼스 정보를 가져와서 저장
    */
    public static function init(){
      $sql ="SELECT major_srl, admission_year FROM members WHERE member_srl = {$_SESSION['user_srl']}";
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
      self::$member_srl = $_SESSION['user_srl'];

      self::$credit= array("general"=>0,"major"=>0,"free"=>0,"BSM"=>0,"design"=>0,"professional"=>0,"total"=>0,"core_challenge"=>'N',"core_creative"=>'N',"core_convergence"=>'N',"core_trust"=>'N',"core_communication"=>'N');
      self::$commonLecture= array("creative"=>"N","Accounting"=>"N","korean_history"=>"N","ACT"=>"N","design"=>"N","English"=>"N", "writing"=>"N");
      self::$majorEssential= array("creativeDesign"=>"N","discreteMath"=>"N","dataStructure"=>"N","programingLanguage"=>"N","cumputerArchitecture"=>"N","Algorithm"=>"N", "os"=>"N","SE"=>"N","c1"=>"N","c2"=>"N","internship"=>"N");
      self::$gpa = 0;
      $sql = "SELECT english, chinese_char,paper,counseling,portfolio,coding_boot_camp,topcit,open_source FROM graduation_status WHERE member_srl = '{$_SESSION['user_srl']}'";
      $graduationdata = DB::getConn()->query($sql)->fetch_assoc();
      self::$graduationStatus= array('english' => $graduationdata['english'],'chinese_char' => $graduationdata['chinese_char'],'paper' => $graduationdata['paper'],'counseling' => $graduationdata['counseling'],'portfolio' => $graduationdata['portfolio'],'coding_boot_camp' => $graduationdata['coding_boot_camp'],'topcit' => $graduationdata['topcit'],'open_source' => $graduationdata['open_source'] );

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
          self::$gpa_major +=(int)self::$attended_lectures[$j]['grade']* (int)self::$attended_lectures[$j]['credit'];
  			  self::$credit['major'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(self::$attended_lectures[$j]['abeek_type']=='BSM'){

  			  self::$credit['BSM'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(preg_match('/(설계)/',self::$attended_lectures[$j]['abeek_type'])){
  			  self::$credit['design'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  if(self::$attended_lectures[$j]['title']=='앙트레프레너십시대의회계'){

          self::$commonLecture['Accounting'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='창의와소통'){
          self::$commonLecture['creative'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='한국사'){

          self::$commonLecture['korean_history'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='글쓰기'){

          self::$commonLecture['writing'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='ACT'){
          self::$commonLecture['ACT'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='COMMUNICATIONINENGLISH'){
          self::$commonLecture['English'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='디자인적사고와문제해결'){
          self::$commonLecture['design'] = "Y";
        }

        if(self::$attended_lectures[$j]['title']=='창의적설계'){
          self::$majorEssential['creativeDesign'] = "Y";
        }
        if(self::$attended_lectures[$j]['title']=='이산수학'){
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
        if(preg_match('/(휴먼ICT소프트웨어공학)/',self::$attended_lectures[$j]['title'])){
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
        if(preg_match('/(핵심-도전)/',self::$attended_lectures[$j]['abeek_type']))
  		  {
  			  self::$credit['core_challenge'] = "Y";
  		  }
        if(preg_match('/(핵심-창의)/',self::$attended_lectures[$j]['abeek_type']))
  		  {
  			  self::$credit['core_creative']= "Y";
  		  }
        if(preg_match('/(핵심-융합)/',self::$attended_lectures[$j]['abeek_type']))
  		  {
  			  self::$credit['core_convergence']= "Y";
  		  }
        if(preg_match('/(핵심-신뢰)/',self::$attended_lectures[$j]['abeek_type']))
  		  {
  			  self::$credit['core_trust']= "Y";
  		  }
        if(preg_match('/(핵심-소통)/',self::$attended_lectures[$j]['abeek_type']))
  		  {
  			  self::$credit['core_communication']= "Y";
  		  }
        if(preg_match('/(전문교양)/',self::$attended_lectures[$j]['abeek_type']))
  		  {

  			  self::$credit['professional'] += (int)self::$attended_lectures[$j]['credit'];
  		  }
  		  self::$gpa += (int)self::$attended_lectures[$j]['grade'] * (int)self::$attended_lectures[$j]['credit'];

  	  }
      self::$credit['total'] = (int)self::$credit['general'] + (int)self::$credit['free'] +(int)self::$credit['major'];
      if(self::$credit['total']!=0){
        self::$gpa /= self::$credit['total'];
      }
      if(self::$credit['major']!=0){
        self::$gpa_major/= self::$credit['major'];
      }



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

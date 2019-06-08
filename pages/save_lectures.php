<?php
var_dump($_POST);
foreach ($_POST as $key => $value) {
  $sql = "SELECT lecture_srl FROM lectures WHERE course_no=$key";
  $lectureInfo=DB::getConn()->query($sql)->fetch_assoc();
  $sql = "INSERT INTO attended_lectures(member_srl,lecture_srl,grade)values({$_SESSION['user_srl']}, {$lectureInfo['lecture_srl']},$value)";
  echo "<br>".$sql."<br>";
  if(DB::getConn()->query($sql)==true){
    echo '성공';
  }else{
    echo 'error : '.DB::getConn()->error;
  }

}
Header("Location:/?act=detail");

 ?>

<?php
  $encryped_password = password_hash($_POST[password], PASSWORD_DEFAULT);
  $conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
  $joinSql = "INSERT INTO members(member_srl,user_id,nickname,email,password,major_srl,admission_year,campus,abeek)VALUES(1,'{$_POST[id]}','{$_POST[nickname]}','{$_POST[email]}','$encryped_password',{$_POST[major]},{$_POST[admission_year]},'{$_POST[campus]}','{$_POST[abeek]}')";
  if(mysqli_query($conn,$joinSql)===false){
    echo '회원가입 중 오류가 발생<br>오류 내용 :';
    echo mysqli_error($conn);
  }
  header('Location: index.php');

 ?>

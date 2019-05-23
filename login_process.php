
<?php
  session_start();
  //login page에서 받아온 id, password
  $id = $_POST[id];
  $password = $_POST[password];
  echo $id."<br>";
  echo '<meta charset="utf-8">';
  //db 연결
  $conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
  //쿼리문
  $loginSql="SELECT * FROM members WHERE user_id='$id'";
  $loginSqlResult = mysqli_query($conn,$loginSql);
  //오류 있는지 확인
  if($loginSqlResult===false){
    echo '디비에서 가져오는 중 문제가 발생:';
    echo mysqli_error($conn);
  }
  //가져온 정보를 배열로 만듬
  $memberInfoArr = mysqli_fetch_array($loginSqlResult);
  //가져온 배열에 user_id가 있으면


  if($memberInfoArr[user_id]!=NULL){
    //비밀번호가 맞으면
    if(password_verify($password, $memberInfoArr[password])){
      //세션 전역 배열(?)에 무엇을 저장할지는 후에 수정
      $_SESSION[is_login] = true; //로그인 되어 있는지 확인 하는데 쓰이는 변수
      $_SESSION[user_id] = $memberInfoArr[user_id];
      $_SESSION[nickname] = $memberInfoArr[nickname];
      echo '로그인 성공 : ';
      echo '<a href="dashboard.php">대시보드 페이지로</a>';
    }else{
      //비밀번호가 틀리면
      echo '비밀번호가 틀렸습니다..';
      echo '<a href="login.php">돌아가기</a>';
    }
  }else{
    //아이디에 해당하는 정보가 없으면
    echo '회원을 찾을 수 없습니다.';
    echo '<a href="login.php">돌아가기</a>';
  }
 ?>

<?php
  if(isset($_POST['submit'])){
    session_start();
    //login page에서 받아온 id, password
    $id = $_POST['id'];
    $password = $_POST['password'];
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


    if($memberInfoArr['user_id']!=NULL){
      //비밀번호가 맞으면
      if(password_verify($password, $memberInfoArr['password'])){
        //세션 전역 배열(?)에 무엇을 저장할지는 후에 수정
        $_SESSION['is_login'] = true; //로그인 되어 있는지 확인 하는데 쓰이는 변수
        $_SESSION['user_id'] = $memberInfoArr['user_id'];
        $_SESSION['nickname'] = $memberInfoArr['nickname'];
        echo '로그인 성공 : ';
        header("Location: dashboard.php");
      }else{
        //비밀번호가 틀리면
        echo '비밀번호가 틀렸습니다..';
        
      }
    }else{
      //아이디에 해당하는 정보가 없으면
      echo '회원을 찾을 수 없습니다.';

    }
  }
?>
 ?>

<!DOCTYPE HTML>
<html>
  <HEAD>
    <!--부트스트랩-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style media="screen">
      .login-input{
        width:100%;
        margin-bottom: 10px;
      }
      .login-container{
        width: 400px;
        border-style: solid;
        padding-bottom: 20px;
      }

    </style>
  </HEAD>

  <body>
    <!--login_process.php로 post 형식으로 아이디: id, 비밀번호: password를 넘김-->
    <div class="container login-container">
      <p><h3>로그인</h3></p>

      <form action="login_process.php" method="post">
        <div class="row">
          <div class="col-5">
            <label for="id">아이디</label>
          </div>
          <div class="col-7">
            <input class="login-input" type="text" name="id">
          </div>
        </div>
        <div class="row">
          <div class="col-5">
            <label for="id">비밀번호</label>
          </div>
          <div class="col-7">
            <input class="login-input" type="password" name="password">
          </div>
        </div>
        <div class="row ">
          <div class="col-4">
            <input type="submit" class="btn btn-primary" name="submit" value="로그인">
          </div>
          <div class="col-4">
            <input type="button" class="btn btn-primary" name="join" onclick="location.href='join.php'" value="회원가입">
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

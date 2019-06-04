<?php

	if(array_key_exists('user_id', $_SESSION)) Header("Location:/?act=dashboard");

	if(isset($_POST['id']) && isset($_POST['password'])){

		if($_POST['id'] == 'admin' && $_POST['password'] == 'admin'){ // DB에서 받아오도록 수정하기
			$_SESSION['user_id'] = 'admin';
			$_SESSION['nickname'] = 'admin';
			Header("Location: /?act=dashboard");
		}

		$id = $_POST['id'];
		$password = $_POST['password'];

		$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
		$loginSql = "SELECT * FROM members WHERE user_id='$id'";
		$loginSqlResult = mysqli_query($conn,$loginSql);
		mysqli_close($conn);

		if($loginSqlResult==false){
			echo "Server DB Error.";
		} else {
			$memberInfoArr = mysqli_fetch_array($loginSqlResult);
			if($memberInfoArr['user_id']!='' && password_verify($password, $memberInfoArr['password'])){
				//session에 member_srl만 저장하도록 바꾸기
				$_SESSION['user_id'] = $memberInfoArr['user_id'];
				$_SESSION['nickname'] = $memberInfoArr['nickname'];
				Header("Location: /?act=dashboard");
			} else {
				echo "다시 로그인하세요.";
			}
		}
	}

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
    <!--login.php로 post 형식으로 아이디: id, 비밀번호: password를 넘김-->
    <div class="container login-container">
      <p><h3>로그인</h3></p>
      <form action="/?act=login" method="post">
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
            <label for="password">비밀번호</label>
          </div>
          <div class="col-7">
            <input class="login-input" type="text" name="password">
          </div>
        </div>
        <div class="row ">
          <div class="col-4">
            <input type="submit" class="btn btn-primary" name="submit" value="로그인">
          </div>
          <div class="col-4">
            <input type="button" class="btn btn-primary" name="join" onclick="location.href='/?act=join'" value="회원가입">
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

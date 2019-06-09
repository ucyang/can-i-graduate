<?php

	if(array_key_exists('user_srl', $_SESSION)) Header("Location:/?act=dashboard");

	if(isset($_POST['id']) && isset($_POST['password'])){

		$id = $_POST['id'];
		$password = $_POST['password'];

		$conn = DB::getConn();
		$loginSql = "SELECT * FROM members WHERE user_id='$id'";
		$loginSqlResult = mysqli_query($conn,$loginSql);

		if($loginSqlResult==false){
			echo "Server DB Error.";
		} else {
			$memberInfoArr = mysqli_fetch_array($loginSqlResult);
			if($memberInfoArr['user_id']!='' && password_verify($password, $memberInfoArr['password'])){
				//session에 member_srl만 저장하도록 바꾸기
				$_SESSION['user_srl'] = $memberInfoArr['member_srl'];
				User::init();

				Header("Location: /?act=dashboard");
			} else {
				echo "다시 로그인하세요.";
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Can I Graduate?</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
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

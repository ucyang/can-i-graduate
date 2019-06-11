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
			

				Header("Location: /?act=dashboard");
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Can I Graduate? - 중앙대학교</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
      html,
      body {
        background: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg') center;
        background-size: cover;
        background-repeat: no-repeat;

        height: 100%;
        margin: 0;

        color: white;
      }

      .login-container {
        width: 100%;
        min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
        min-height: 100vh; /* These two lines are counted as one :-)       */

        display: flex;
        align-items: center;
        align-content: center;
      }
    </style>
  </head>
  <body>
    <!--login.php로 post 형식으로 아이디: id, 비밀번호: password를 넘김-->
    <div class="container-fluid login-container">
      <div style="margin: auto; border: 1px solid white; padding: 25px">
        <h1 class="text-center"><span class="glyphicon glyphicon-education"></span></h1>
        <h1 class="text-center">Can I Graduate?</h1>
        <h2 class="text-center">중앙대학교</h2>
        <hr />
        <form action="/?act=login" method="post">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="id" type="text" class="form-control" name="id" placeholder="ID" autofocus="autofocus">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span> 로그인</button>
          <hr />
          <button type="button" class="btn btn-info btn-block" onclick="location.href='/?act=join'"><span class="glyphicon glyphicon-plus"></span> 회원가입</button>
        </form>
      </div>
    </div>
  </body>
</html>

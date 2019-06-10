<?php
	if(array_key_exists('user_id', $_SESSION)) Header("Location:/?act=dashboard");

	if(isset($_POST['password']))
	{
		$encryped_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		//get major_srl from db
		$selectSql = "SELECT major_srl FROM majors WHERE name = '{$_POST['major']}'";
		$sqlResult = DB::getConn()->query($selectSql);
		if ($sqlResult)
		{

			$select_major_srl = $sqlResult->fetch_assoc();
			var_dump($select_major_srl);
		}
		else
		{
			//select fail
		    echo "Error: ".DB::getConn()->error;
		}

		echo $select_major_srl['major_srl'];
		//insert user info to db
		$insertSql = "INSERT INTO members (user_id,nickname,email,password,major_srl,admission_year,abeek) VALUES
		('{$_POST['id']}','{$_POST['nickname']}','{$_POST['email']}','$encryped_password', {$select_major_srl['major_srl']} , {$_POST['admission_year']},'{$_POST['abeek']}')";
		if (DB::getConn()->query($insertSql) === TRUE)
		{
			//insert success
	    echo "New record created successfully";
		}
		else
		{
			//insert fail
		    echo "Error: " . DB::getConn()->error;
		}

		$selectSql = "SELECT member_srl FROM members WHERE user_id = '{$_POST['id']}'";
		$memberSRL = DB::getConn()->query($selectSql)->fetch_assoc();

		$insertGraduationStatusSql = "INSERT INTO graduation_status(member_srl, gpa,gpa_major,english,chinese_char,paper,counseling,portfolio,coding_boot_camp,topcit,open_source)
																		VALUES('{$memberSRL['member_srl']}',0,0,'X','X','X','X','X','X','X','X')";
		DB::getConn()->query($insertGraduationStatusSql);
		Header("Location: /?act=login");
	}
	// 회원 가입 중 취소
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Sign Up - Can I Graduate?</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <!--
      아이디 id
      비밀번호 password
      이름 name
      이메일 email
      대학교 university
      전공 major
      입학년도 entrance_year가
      join.php로 넘어감
    -->
    <div class="container">
      <p><h3>회원가입 페이지</h3></p>
      <form action="/?act=join" method="post">
        <div class="form-group">
          <label for="id">아이디</label>
          <input class="form-control" type="text" name="id" placeholder="아이디를 입력해주세요" required name='id'>
        </div>
        <div class="form-group">
          <label for="password">비밀번호</label>
          <input class="form-control" type="password" name="password" placeholder="비밀번호를 입력해주세요" required name='password'>
        </div>
        <div class="form-group">
          <label for="nickname">닉네임</label>
          <input class="form-control" type="text" name="nickname" placeholder="이름을 입력해주세요" required name='nickname'>
        </div>
        <div class="form-group">
          <label for="email">이메일</label>
          <input class="form-control" type="email" name="email" placeholder="이메일을 입력해주세요" required name='email'>
        </div>
        <div class="form-group">
          <label for="university">대학교</label>
          <select class="form-control" id="university" name='university'>
            <option value='cau'>중앙대학교</option>
          </select>
        </div>
        <div class="form-group">
          <label for="major">전공</label>
          <select class="form-control" id="major" name='major'>
            <option value='컴퓨터공학부'>컴퓨터공학부</option>
            <option value='소프트웨어전공'>소프트웨어전공</option>
            <option value='소프트웨어학부'>소프트웨어학부</option>
          </select>
        </div>
        <div class="form-group">
          <label for="admission_year">입학년도</label>
          <select class="form-control" id="admission_year" name='admission_year'>
            <option value='2013'>2013</option>
            <option value='2014'>2014</option>
            <option value='2015'>2015</option>
            <option value='2016'>2016</option>
            <option value='2017'>2017</option>
            <option value='2018'>2018</option>
          </select>
        </div>
        <div class="form-group">
          <label for="campus">캠퍼스</label>
          <select class="form-control" id="campus" name='campus'>
            <option value='서울'>서울캠퍼스</option>
            <option value='안성'>안성캠퍼스</option>
          </select>
        </div>
        <div class="form-group">
          <label for="abeek">공학인증 여부</label>
          <select class="form-control" id="abeek" name='abeek'>
            <option value='1'>O</option>
            <option value='0'>X</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">확인</button>
        <button name="cancel" class="btn btn-primary" onclick="location.href='/?act=login'">취소</button>
      </form>
    </div>
 </body>
</html>

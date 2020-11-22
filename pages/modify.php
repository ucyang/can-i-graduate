<?php
  $selectSql = "SELECT * FROM members WHERE member_srl = {$_SESSION['user_srl']}";

  if($result = DB::getConn()->query($selectSql))
  {

    $member_info =$result->fetch_assoc();
  }else {
     echo 'Error: '.DB::getConn()->error;
  }

	if(isset($_POST['password']))
	{

		$encryped_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		//get major_srl from db
		$selectSql = "SELECT major_srl FROM majors WHERE name = '{$_POST['major']}'";
		$sqlResult = DB::getConn()->query($selectSql);
		if ($sqlResult)
		{

			$select_major_srl = $sqlResult->fetch_assoc();

		}
		else
		{
			//select fail
		    echo "Error: ".DB::getConn()->error;
		}

		echo $select_major_srl['major_srl'];
		//insert user info to db
		$updateSql = "UPDATE members
                  SET password ='$encryped_password',
                  major_srl = {$select_major_srl['major_srl']},
                  nickname = '{$_POST['nickname']}',
                  email = '{$_POST['email']}',
                  admission_year ={$_POST['admission_year']},
                  abeek ='{$_POST['abeek']}'
                  WHERE member_srl ={$_SESSION['user_srl']}";
		if (DB::getConn()->query($updateSql) === TRUE)
		{
			//insert success
	    echo "update successfully";
		}
		else
		{
			//insert fail
		    echo "Error: " . DB::getConn()->error;
		}


		Header("Location: /?act=logout");
	}
	// 회원 가입 중 취소
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Modify - Can I Graduate?</title>

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
      <p><h3>회원 정보 수정</h3></p>
      <form action="/?act=modify" method="post">
        <div class="form-group">
          <label for="id">아이디</label>
          <input class="form-control" type="text" name="id" placeholder="아이디를 입력해주세요" required name='id' value='<?php echo $member_info['user_id']; ?>' disabled>
        </div>
        <div class="form-group">
          <label for="password">비밀번호</label>
          <input class="form-control" type="password" name="password" placeholder="비밀번호를 입력해주세요" required name='password' >
        </div>
        <div class="form-group">
          <label for="nickname">닉네임</label>
          <input class="form-control" type="text" name="nickname" placeholder="이름을 입력해주세요" required name='nickname' value='<?php echo $member_info['nickname']; ?>'>
        </div>
        <div class="form-group">
          <label for="email">이메일</label>
          <input class="form-control" type="email" name="email" placeholder="이메일을 입력해주세요" required name='email' value='<?php echo $member_info['email']; ?>'>
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
        <button name="cancel" class="btn btn-primary" onclick="location.href='/?act=dashboard'">취소</button>
      </form>
    </div>
 </body>
</html>

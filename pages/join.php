<?php

	if(array_key_exists('user_id', $_SESSION)) Header("Location:/?act=dashboard");

	if(isset($_POST['password'])){
		$encryped_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		DB::connectDB();
		$arr = [
			'dept'=>$_POST['major']
		];

		$select_major_srl = DB::select('majors', 'major_srl',$arr);
		$insert=[
			'user_id' => $_POST['id'],
			'nickname'=>$_POST['nickname'],
			'email'=> $_POST['email'],
			'password'=>$encryped_password,
			'major_srl'=> $select_major_srl[0]['major_srl'],
			'admission_year'=>$_POST['admission_year'],
			'campus'=>$_POST['campus'],
			'abeek'=>$_POST['abeek']
		];
		DB::insertPrepare('members',$insert);
		DB::bindParam(["ssssiiss"]+$insert);
		DB::execute();
		/*
		$joinSql = "INSERT INTO members (user_id,nickname,email,password,major_srl,admission_year,campus,abeek) VALUES
		('{$_POST['id']}','{$_POST['nickname']}','{$_POST['email']}','$encryped_password', (SELECT major_srl FROM majors
		WHERE dept = '{$_POST['major']}'), {$_POST['admission_year']},'{$_POST['campus']}','{$_POST['abeek']}')";

		if(mysqli_query($conn,$joinSql)===false){
			echo "회원 가입 오류 : " . mysqli_error($conn);
		} else {
			mysqli_close($conn);
			Header("Location:/?act=login");
		}*/
	}
	// 회원 가입 중 취소

?>
<!DOCTYPE HTML>
<html>
  <HEAD>
    <!--부트스트랩-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
    </script>
  </HEAD>
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
            <option value='000'>컴퓨터공학부</option>
            <option value='001'>소프트웨어전공</option>
            <option value='002'>소프트웨어학부</option>
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
            <option value='2019'>2019</option>
          </select>
        </div>
        <div class="form-group">
          <label for="campus">캠퍼스</label>
          <select class="form-control" id="campus" name='campus'>
            <option value='anseong'>안성캠퍼스</option>
            <option value='seoul'>서울캠퍼스</option>
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

<?php
	session_start();
	if(! array_key_exists('user_id', $_SESSION)) Header("Location:./login.php");
	
	$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');

	/*	관리자인 경우
	
	- 전 범위 정기적으로 자동 갱신하기
	- 학사요강 제공을 위한 JSON 만들기
	- 교직이수, 복수전공 등은 추후 고민
	- class 마다 parsing 한 후 제공함
	
	*/
	if($_SESSION['user_id']=='admin'){ // []. () : function
		$json_string = './2018_1_UC_SC_ICT_CE.json';
		$json_data = file_get_contents($json_string);
		$lecture = json_decode($json_data, true);
		foreach ($lecture[selectSust] as $record){ // $arr as $k=>$v
			echo $record[pobtnm];
			$sql = "INSERT INTO lectures (course_no,class_no,year,password,major_srl,admission_year,campus,abeek) VALUES 
		('{$_POST[id]}','{$_POST[nickname]}','{$_POST[email]}','$encryped_password', {$_POST[major]},
		{$_POST[admission_year]},'{$_POST[campus]}','{$_POST[abeek]}')";
			
		
		}			
		
		/*
		foreach ($rows as $row) {
			print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
		$categories = array('교직', '핵심교양', '전공필수');
			if(in_array($_POST['category'], $categories)){
		foreach ($rows as $row) {
			print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
			
		try {
			$db = new PDO("mysql:host='127.0.0.1';dbname='can_i_graduate'", 'cig_admin', '1');
		} catch (Exception $e) {
			$e->getMessage();
			exit();
		}
		$fh = fopen($target_file, 'rb');
		$stmt = $db->prepare('INSERT INTO lectures ())
		
		$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
		$loginSql = "SELECT * FROM attended_lectures WHERE user_id='$_SESSION[user_id]' AND ";
		$loginSqlResult = mysqli_query($conn,$loginSql);
		mysqli_close($conn);
		
		$memberInfoArr = mysqli_fetch_array($loginSqlResult);
		*/
	}
	/*	사용자인 경우
	
	- 일부 입력은 여기서 받도록 대체
	- 학기 별 일정, 진행상황 보여주기
	- 가능하면 planner UI로 확장하기
	- 이러면 학기 생성, 성적 확정 필요
	
	*/
	else{
		// 성적 올리기
		
print <<<_HTML_
	<form method="post" enctype="multipart/form-data">
		올리기 : <input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload" name="submit">
	</form>
_HTML_;

		
		$target_dir = "/workspace/PHP/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if($FileType != ""){ // $_FILES["fileToUpload"]["size"]
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if($FileType != "csv") {
				echo "Sorry, only csv files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo " Your file is not uploaded.";
			} else {	
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
				} else {
					echo "Server Error";
				}
			}
		}
		// 보관 성적 자동 불러오기, 계산하기
		// detailPage로 넘어가기
		// logOut 하기
		// 회원 가입 중 취소, 회원 정보 수정, 회원 탈퇴 회원탈퇴 시 쿠키 처리
		// unset($_SESSION['user_id']);*/
	}
	//require 'dashboard_view.php';
	mysqli_close($conn);
?>
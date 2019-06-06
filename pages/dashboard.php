<?php

	if(! array_key_exists('user_srl', $_SESSION)) Header("Location:/?act=login");

	$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');

	/*	관리자인 경우

	- 전 범위 정기적으로 자동 갱신하기
	- 학사요강 제공을 위한 JSON 만들기
	- 교직이수, 복수전공 등은 추후 고민
	- class 마다 parsing 한 후 제공함

	*/
	$sql = "SELECT user_id FROM members where member_srl = '{$_SESSION['user_srl']}'";
	$sqlResult = DB::getConn()->query($sql);
	if($sqlResult==false){
		echo "ERROR : ". DB::getConn()->error;
	}else{
		$memberinfo = $sqlResult->fetch_assoc();

	}

	if($memberinfo['user_id']=='admin'){ // []. () : function
		$json_string = '../tmp/2018_1_UC_SC_ICT_CE.json';
		$json_data = file_get_contents($json_string);
		$lecture = json_decode($json_data, true);
		foreach ($lecture['selectSust'] as $record){ // $arr as $k=>$v
			// [remk](비고), [pnt](학점-시간) parsing 필요.
			// clssnmlk, profnmlk는 classnm, profnm과 중복됨.
			// 'seoul', 'cau' 부분도 참조 가능하지만 놔둠.
			echo $record['clssnm'];
			$sql = "INSERT INTO lectures (course_no, class_no, year, semester, campus,
			college, dept, title, inst_name, credit, course_class, course_type, abeek_type) VALUES
			($record[sbjtno], $record[clssno], $record[shyr], $record[shyr2], 'seoul',
			'cau', $record[colgnm], $record[clssnm], $record[profnm], 3, $record[sustnm], $record[pobtnm], $record[remk])";
		}
	}
	/*	사용자인 경우

	- 일부 입력은 여기서 받도록 대체
	- 학기 별 일정, 진행상황 보여주기
	- 가능하면 planner UI로 확장하기
	- 이러면 학기 생성, 성적 확정 필요

	*/
	else{
/*
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
*/
		// detailPage로 넘어가기


		// 보관 성적 자동 '갱신'하기, 종합지표 계산하기
		/*
		$row = 1;
		if (($handle = fopen($target_file, "r")) !== FALSE) {
  			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    			$num = count($data);
    			echo "<p> $num fields in line $row: <br /></p>\n";
    			$row++;
    			for ($c=0; $c < $num; $c++) {
        			echo $data[$c] . "<br />\n";
    			}
  			}
  			fclose($handle);
		}
*/

require "dashboard_view.php";
		// 회원 정보 수정, 회원 탈퇴(쿠키 처리)
}
?>

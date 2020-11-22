<?php

	if(! array_key_exists('user_srl', $_SESSION)) Header("Location:/?act=login");

	$sql = "SELECT nickname FROM members where member_srl = {$_SESSION['user_srl']}";
	$sqlResult = DB::getConn()->query($sql);
	if($sqlResult==false){
		echo "ERROR : ". DB::getConn()->error;
	}else{
		$memberinfo = $sqlResult->fetch_assoc();

	}
	User::init();
	User::getattendedLectures();
	

	User::getGraduationStatus();

	/*
	관리자로 로그인 하면 강의들을 불러와 db에 저장함
	*/

	if($memberinfo['nickname']=='admin')
	{
		File::connectFile(CIG_BASEDIR."/config/lecture.csv");
		File::parseLecturesFile();
		File::closeFile();
		/*
		File::connectFile(CIG_BASEDIR."/config/lecture(2).csv");
		File::parseLecturesFile();
		File::closeFile();
		File::connectFile(CIG_BASEDIR."/config/lecture(3).csv");
		File::parseLecturesFile();
		File::closeFile();*/
	}




	require "dashboard_view.php";
		// 회원 정보 수정, 회원 탈퇴(쿠키 처리)

?>

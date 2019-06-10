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
	// portfolio, internship, 시험일정 등 관리하기
	require 'detail_view.php';
?>

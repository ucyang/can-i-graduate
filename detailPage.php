<?php
	session_start();
	if(! array_key_exists('user_id', $_SESSION)) Header("Location:./login.php");

	// portfolio, internship, 시험일정 등 관리하기
	
?>
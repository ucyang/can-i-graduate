<?php
	// $_SESSION[is_login]=true 대신 unset
	// View 분리 (Model 분리는 추후 진행)
	// SQL AUTO INCREMENT
	// 회원가입 취소? 회원탈퇴, 회원정보수정
	// error message printing
	// echo '<meta charset="utf-8">'

	session_start();
	if(array_key_exists('user_id', $_SESSION)) Header("Location:./dashboard.php");
	else Header("Location:./login.php");
?>
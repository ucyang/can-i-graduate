<?php
	session_start();
	if(array_key_exists('user_id', $_SESSION)) Header("Location:./dashboard.php");
	
	if($_POST[password] != ''){
		$encryped_password = password_hash($_POST[password], PASSWORD_DEFAULT);
		
		$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
		$joinSql = "INSERT INTO members (user_id,nickname,email,password,major_srl,admission_year,campus,abeek) VALUES 
		('{$_POST[id]}','{$_POST[nickname]}','{$_POST[email]}','$encryped_password', (SELECT major_srl FROM majors
		WHERE dept = '{$_POST[major]}'), {$_POST[admission_year]},'{$_POST[campus]}','{$_POST[abeek]}')";
		
		if(mysqli_query($conn,$joinSql)===false){
			echo "회원 가입 오류 : " . mysqli_error($conn);
		} else {
			mysqli_close($conn);
			Header("Location:./login.php");
		}
	}
	// 회원 가입 중 취소 
	require 'join.html';
?>
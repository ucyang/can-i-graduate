<?php
	session_start();
	if(array_key_exists('user_id', $_SESSION)) Header("Location:./dashboard.php");
	
	if($_POST[id] != '' && $_POST[password] != ''){
		$id = $_POST[id];
		$password = $_POST[password];
		
		$conn = mysqli_connect('127.0.0.1','cig_admin','1','can_i_graduate');
		$loginSql = "SELECT * FROM members WHERE user_id='$id'";
		$loginSqlResult = mysqli_query($conn,$loginSql);
		mysqli_close($conn);
		
		if($loginSqlResult==false){
			echo "Server DB Error.";
		} else {
			$memberInfoArr = mysqli_fetch_array($loginSqlResult);
			if($memberInfoArr[user_id]!='' && password_verify($password, $memberInfoArr[password])){
				$_SESSION[user_id] = $memberInfoArr[user_id];
				$_SESSION[nickname] = $memberInfoArr[nickname];
				Header("Location:./dashboard.php");
			} else {
				echo "다시 로그인하세요.";
			}
		}
	} else if($_POST[id] != '' || $_POST[password] != '')
		echo "다시 로그인하세요.";

	// require 'login_view.php';
	require 'login.html';
?>
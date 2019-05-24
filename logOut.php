<?php
	 // unset($_SESSION['user_id']);
	session_start();
	session_destroy();

	echo "이용해주셔서 감사합니다."; 

	echo '<a href="login.php">메인으로 돌아가기</a>';
?>



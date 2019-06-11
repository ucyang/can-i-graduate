<?php
	 // unset($_SESSION['user_id']);

	session_destroy();

	echo "이용해주셔서 감사합니다.";

	Header("Location: /?act=login");
?>

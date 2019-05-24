<?php
	// view 분리 (DB외 class model 분리는 추후 진행)
	
	// 전공 목록을 DB에 미리 저장된 것들을 받아오도록 수정하기
	// AUTO INCREMENT 추가하기, 실제 등록 시에만 증가하기
	// 성적 계산 등의 연산들을 모두다 SQL 질의로 대체하기?
	// error message의 보다 세련된 출력(배열 이용하기)
	// 인증된 사용자의 일부 file 접근 방지 구현하기
	// '<meta charset="utf-8">' 사용하기?
	// $_SESSION의 다른 용도?

	session_start();
	if(array_key_exists('user_id', $_SESSION)) Header("Location:./dashboard.php");
	else Header("Location:./login.php");
?>
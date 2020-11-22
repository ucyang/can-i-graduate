<?php


//오류 변수
$error = $_FILES['file']['error'];
//이름
$name = $_FILES['file']['name'];


// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}
move_uploaded_file( $_FILES['file']['tmp_name'], CIG_BASEDIR."/config/".$name);

File::connectFile(CIG_BASEDIR."/config/".$name);
File::parseUploadFile();
File::closeFile();
Header("Location:/?act=detail");
 ?>

<?php

require 'former.php';

/*
	10.5

	- 사용자명과 비밀번호를 요청하는 폼 출력
	- 폼 제출 확인
	- 제출된 비밀번호가 맞다면, 사용자명을 세션에 추가
	- 인증된 사용자만 할 수 있는 작업에서 세션의 사용자명 확인
	- 사용자가 로그아웃하면 세션의 사용자명 삭제
	
	예제 10-17에서 hash 참조하기
*/
session_start( ); // setcookie('username', '...', time() + 1, '/', 'https://.../', true, true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($errors, $input) = validate_form();
    if ($errors) {
        show_form($errors);
    } else {
        process_form($input);
    }
} else {
    show_form();
}
function show_form($errors = array()) {
    // No defaults of our own, no nothing to pass to the
    // FormHelper constructor
    $form = new former();
    // Build up the error HTML to use later
    if ($errors) {
        $errorHtml = '<ul><li>';
        $errorHtml .= implode('</li><li>',$errors);
        $errorHtml .= '</li></ul>';
    } else {
        $errorHtml = '';
    }
    // This form is small, so we'll just print out its components
    // here.
	// vs All HTML displaying the form is placed in a separate file.
	// PHP_SELF : URL after domain
	// require, include는 코드 덧붙이기. form이 실행되어지면 페이지는 다시 그려진다.
print <<<_FORM_
<form method="POST" action="{$form->encode($_SERVER['PHP_SELF'])}">
  $errorHtml
  Username: {$form->input('text', ['name' => 'username'])} <br/>
  Password: {$form->input('password', ['name' => 'password'])} <br/>
  {$form->input('submit', ['value' => 'Log In'])}
</form>
_FORM_;
}
function validate_form( ) {
	// global $conn;
    $input = array();
    $errors = array();
    
	$password_ok = false;
	
	$input = $_POST['username'] ?? '';
	$submitted_password = $_POST['password'] ?? '';
	
	print $input;
	print $submitted_password;
	
	$servername = "localhost";
	$username = "root";
	$password = "1";
	$dbname = "myDB";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$stmt = $conn->prepare('SELECT pw FROM MyGuests WHERE id = ":eee"');
	$stmt->bindParam(':eee', $input);
	$result = $stmt->execute();
	$row = $result->fetch();
	
	if($row){
		// $password_ok = password_verify($submitted_password, $row[0]);
		$password_ok = array_key_exists($submitted_password, $row["pw"]);
	}
	if(! $password_ok){
		$errors[] = '올바른 사용자명과 비밀번호를 입력해주세요.';
	}
	return array($errors, $input);
}

function process_form($input) {
    // Add the username to the session
	/*
	global $database;
	do checkbox action;
	update database; // database.php
	*/	
    $_SESSION['username'] = $input['username'];
    print "Welcome, $_SESSION[username]";
	Header("Location:./index.php");
}

if(isset($_SESSION['count'])){
	$_SESSION['count']=$_SESSION['count']+1;
} else {
	$_SESSION['count']=1;
}

print "당신은 이 페이지를 " . $_SESSION['count'] . '번 보셨습니다.'; // $_COOKIE['userid'];

?>

<?php
/*
	예제 10-19
	headers aleady sent 오류 : include나 require 도 조사해서 print나 HTML 구문 확인
	혹은 output buffering 사용
*/
session_start();

// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
$servername = "localhost";
$username = "root";
$password = "1";
$dbname = "myDB";

// $stmt->close();
// $conn->close();

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO MyGuests (id, pw) 
    VALUES (:firstname, :lastname)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);

    // insert a row
    $firstname = "John";
    $lastname = "Doe";
    $stmt->execute();

    echo "New records created successfully";
	
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// $conn = null;

if(array_key_exists('username', $_SESSION)){
	print "대시보드 자료를 불러옵니다.";
	require 'upload.php';
	
	unset($_SESSION['username']);
	print '이용해주셔서 감사합니다.';
	
} else {
	print '가입 후 이용하실 수 있습니다.'; // 출력되냐?
	Header("Location:./login.php");

}

?>

<html>
	<title>
	</title>
	<body>
	</body>
</html>
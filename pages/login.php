<?php
    // require_once('./config/dbconnect.php');
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "inseong";

	$conn = new mysqli($host, $user, $pass, $db);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
		$password = $_POST["password"];

		$sql = "SELECT user_idx FROM users WHERE username = '$username' and password = '$password'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userIdx = $row["user_idx"];
			session_start();
            $_SESSION["user_idx"] = $userIdx;
            echo $_SESSION["user_idx"];
			header("location: /");
		} else {
			$error = "아이디 또는 비밀번호가 잘못되었습니다.";
		}
	}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="./pages/style.css">
</head>
<body>
    <div class="container">
        <h2>로그인</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">아이디</label>
                <input type="text" id="username" name="username" required placeholder="이름을 입력하세요.">
            </div>
            <div class="form-group">
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password" required placeholder="비밀번호를 입력하세요.">
            </div>
            <button type="submit">로그인</button>
        </form>
    </div>
</body>
</html>

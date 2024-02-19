<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    try {
        $sql = "INSERT INTO users (username, password, email, phone_number, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password, $email, $phone_number, $gender]);
        echo "회원가입이 성공적으로 완료되었습니다.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="./pages/style.css">
</head>
<body>
    <div class="container">
        <h2>회원가입</h2>
        <form action="/" method="post">
            <div class="form-group">
                <label for="name">아이디</label>
                <input type="text" id="name" name="name" required placeholder="아이디를 입력하세요.">
            </div>
            <div class="form-group">
                <label for="email">비밀번호</label>
                <input type="password" id="password" name="password" required placeholder="비밀번호를 입력하세요.">
            </div>
            <div class="form-group">
                <label for="password">이메일</label>
                <input type="email" id="email" name="email" required placeholder="이메일을 입력하세요.">
            </div>
            <div class="form-group">
                <label for="phone">전화번호</label>
                <input type="tel" id="phone" name="phone" required placeholder="전화번호를 입력하세요.">
            </div>
            <div class="form-group">
                <label>성별</label><br>
                <input type="radio" id="male" name="gender" value="man" required>남자</input>
                <input type="radio" id="male" name="gender" value="woman" required>여자</input>
            </div>
            <button type="submit">회원가입</button>
        </form>
    </div>
</body>
</html>

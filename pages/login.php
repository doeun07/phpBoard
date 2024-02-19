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
        <form action="./login_process.php" method="post">
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

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container posting_container">
        <h2>게시글 작성</h2>
        <form action="./post_process.php" method="post">
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" required placeholder="제목을 입력하세요.">
            </div>
            <div class="form-group">
                <label for="content">내용</label>
                <textarea id="content" name="content" required placeholder="내용을 입력하세요."></textarea>
            </div>
            <button type="submit">게시글 작성</button>
        </form>
    </div>
</body>
</html>

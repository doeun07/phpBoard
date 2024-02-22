<?php
//로그인 검증
if (!isset($_SESSION["user_idx"])) {
    echo "
    <script>
    alert('로그인 후 이용 가능합니다.')
    location.href = './login';
    </script>
    ";
}

//글 작성 로직
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_idx = $_SESSION["user_idx"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    try {
        $sql = "INSERT INTO posts (user_idx, title, content) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_idx, $title, $content]);
        echo "
        <script>
        alert('게시글이 작성되었습니다.')
        location.href = './posts';
        </script>
        ";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>


<div class="container posting_container">
    <h2>게시글 작성</h2>
    <form action="posting" method="post">
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" required placeholder="제목을 입력하세요.">
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea id="content" name="content" required placeholder="내용을 입력하세요."></textarea>
        </div>
        <button type="submit">게시글 등록</button>
    </form>
</div>
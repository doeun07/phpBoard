<?php
parse_str($path[1], $output);
$postId = $output["postId"];


$sql = "SELECT title, content FROM posts WHERE post_idx = :postId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":postId", $postId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//글 수정 로직
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    try {
        $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE post_idx = :postId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":postId", $postId);
        $stmt->execute();
        echo "
        <script>
        alert('게시글 수정이 완료되었습니다.')
        location.href = './posts';
        </script>
        ";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<div class="container posting_container">
    <h2>게시글 수정</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" required value="<?= $user['title'] ?>">
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea id="content" name="content" required><?= $user['content'] ?></textarea>
        </div>
        <button type="submit">게시글 수정</button>
    </form>
    <button type="button" id="<?= $postId ?>" onClick='postDelete(this)'>게시글 삭제</button>
</div>
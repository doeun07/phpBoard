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
// 글 삭제 로직
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "UPDATE posts SET is_deleted = 0 WHERE post_idx = :post_idx";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':post_idx', $postId);
    $stmt->execute();
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
    <form action="" method="GET">
        <button type="button" onClick='postDelete(this)'>게시글 삭제</button>
    </form>
</div>
<script>
    function postDelete(elem){
        const post_idx = elem.id;
        const isConfirm = confirm(`정말로 <?=$postId?>번 게시글을 삭제하시겠습니까?`);
        if(isConfirm) {
            $.ajax({
                url: './admin',
                type: 'POST',
                data: {"post_idx": post_idx},
                success: function() {
                    alert("정상적으로 게시글이 삭제되었습니다.");
                    location.href = './posts';
                },
                error: function() {
                    alert("게시글 삭제 중 문제가 발생하였습니다.");
                }
            })
        } else {
            alert("게시글 삭제가 취소되었습니다.");
        }
        return console.log(elem);
    }
</script>
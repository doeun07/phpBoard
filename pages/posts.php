<?php
$sql = "SELECT * FROM posts WHERE is_deleted = 0 ORDER BY write_date DESC"; //ASC = 오름차순, DESC = 내림차순
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container posts_container">
    <h2>게시글 목록</h2>
    <?php
    if ($posts) {
        foreach ($posts as $post) {
            $sql = "SELECT * FROM users WHERE user_idx = :user_idx";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_idx", $post["user_idx"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $divinnertext = "";
            $divinnertext .= "<div class='post container'>";
            $divinnertext .= "<h3>" . $post["title"] . "</h3>";
            $divinnertext .= "<p class='textsm'>작성자 ID : " . $user["username"] . "</p>";
            $divinnertext .= "<p class='textsm'>게시글 ID : " . $post["post_idx"] . "</p>";
            $divinnertext .= "<p class='textsm'>작성일 : " . $post["write_date"] . "</p>";
            $divinnertext .= "<p class='textmd'>" . $post["content"] . "</p>";
            if($post["user_idx"] == $_SESSION["user_idx"]) {
                $divinnertext .= "<a href='./update?postId=" . $post["post_idx"] . "'><button type='submit'>수정하기</button></a>";
                $divinnertext .= "<button id='" . $post["post_idx"] . "' onClick='postDelete(this);'>삭제하기</button>";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $sql = "UPDATE posts SET is_deleted = 1 WHERE post_idx = :post_idx";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':post_idx', $_POST["post_idx"]);
                    $stmt->execute();
                }
            }
            $divinnertext .= "</div>";
            echo $divinnertext;
        }
    }
    ?>
</div>

<script>
    function postDelete(elem){
        const post_idx = elem.id;
        const isConfirm = confirm(`정말로 ${post_idx}번 게시글을 삭제하시겠습니까?`);
        if(isConfirm) {
            $.ajax({
                url: './admin',
                type: 'POST',
                data: {"post_idx": post_idx},
                success: function() {
                    alert("정상적으로 게시글이 삭제되었습니다.");
                    location.href = './admin';
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
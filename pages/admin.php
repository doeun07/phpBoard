<?php
//관리자 검증
if (!isset($_SESSION["user_idx"])) {
    echo "
    <script>
    alert('로그인 후 이용 가능합니다.')
    location.href = './login';
    </script>
    ";
} else {
    if(!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 0) {
        echo "
        <script>
        alert('관리자만 이용가능한 페이지 입니다.')
        location.href = '/';
        </script>
        ";
    }
}
$sql = "SELECT * FROM posts WHERE is_deleted = 0 ORDER BY write_date DESC"; //ASC = 오름차순, DESC = 내림차순
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script>
    alert('게시글을 삭제하시겠습니까?');
    </script>";
}
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
            $divinnertext .= "<form action='admin' method='post'>";
            $divinnertext .= "<div class='post container'>";
            $divinnertext .= "<h3>" . $post["title"] . "</h3>";
            $divinnertext .= "<p class='textsm'>작성자 ID : " . $user["username"] . "</p>";
            $divinnertext .= "<p class='textsm'>게시글 ID : " . $post["post_idx"] . "</p>";
            $divinnertext .= "<p class='textsm'>작성일 : " . $post["write_date"] . "</p>";
            $divinnertext .= "<p class='textmd'>" . $post["content"] . "</p>";
            $divinnertext .= "<button type='submit'>게시글 삭제하기</button>";
            $divinnertext .= "</div>";
            $divinnertext .= "</form>";
            echo $divinnertext;
        }
    }
    ?>
</div>
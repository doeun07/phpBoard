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
            $divinnertext .= "</div>";
            echo $divinnertext;
        }
    }
    ?>
</div>
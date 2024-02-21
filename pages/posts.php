<?php
$sql = "SELECT * FROM posts WHERE is_deleted = 0 ORDER BY write_date DESC"; //ASC = 오름차순, DESC = 내림차순
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div>
    <h1>게시글 목록</h1>
    <?php
    if ($posts) {
        foreach ($posts as $post) {
            $sql = "SELECT * FROM users WHERE user_idx = :user_idx";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_idx", $post["user_idx"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $divinnertext = "";
            $divinnertext .= "<div class='post'>";
            $divinnertext .= "<h2>" . $post["title"] . "</h2>";
            $divinnertext .= "<p>작성자 ID : " . $user["username"] . "</p>";
            $divinnertext .= "<p>게시글 ID : " . $post["post_idx"] . "</p>";
            $divinnertext .= "<p>" . $post["content"] . "</p>";
            $divinnertext .= "</div>";
            echo $divinnertext;
        }
    }
    ?>
</div>
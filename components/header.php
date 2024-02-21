<link rel="stylesheet" href="../css/header.css">
<header>
    <div id="left">
        <span><a href="/">인성터진 게시판</a></span>
    </div>
    <div id="right">
        <ul>
            <?php
            if(isset($_SESSION["user_idx"])) {
                echo "
                <li><a href='./logout'>로그아웃</a></li>
                <li><a href='./posting'>게시글 작성</a></li>
                ";
            } else {
                echo "
                <li><a href='./login'>로그인</a></li>
                <li><a href='./register'>회원가입</a></li>
                ";
            }
            ?>
        </ul>
    </div>
</header>
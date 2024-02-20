<?php
session_start();
if(isset($_SESSION["user_idx"])) {
    echo "로그인 됨";
} else {
    echo "로그아웃 됨";
};

function logout() {
    session_destroy();
}

?>

<h1>Root Directory Access</h1>
<a href="register">회원가입</a>
<a href="login">로그인</a>
<form action="" method="POST">
    <button type="submit" onclick="<?php logout(); ?>">로그아웃</button>
</form>
<?php
//관리자 검증
if(!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {
    echo "관리자 페이지";
} else {
    echo "
    <script>
    alert('관리자만 이용가능한 페이지 입니다.')
    location.href = '/';
    </script>
    ";
}
?>
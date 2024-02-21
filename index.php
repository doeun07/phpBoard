<?php
include('./config/dbconnect.php');
session_start();

$request = $_SERVER['REQUEST_URI']; //URI과 URL, URN의 차이는?
$path = explode("?", $request);
$path[1] = isset($path[1]) ? $path[1] : null;
$resource = explode("/", $path[0]);
echo "<script>console.log('path[0] = " . $path[0] . "');</script>";
echo "<script>console.log('path[1] = " . $path[1] . "');</script>";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Router</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
$page = "";
include('./components/header.php');
switch ($resource[1]) {
    case '':
        $page = "./pages/main.php";
        break;
    case 'login':
        $page = "./pages/" . $resource[1] . ".php";
        break;
    case 'register':
        $page = "./pages/" . $resource[1] . ".php";
        break;
    case 'logout':
        $page = "./pages/" . $resource[1] . ".php";
        break;
    case 'posting':
        $page = "./pages/" . $resource[1] . ".php";
        break;
    case 'posts':
        $page = "./pages/" . $resource[1] . ".php";
        break;
    default:
        $page = "./pages/404.php";
        break;
}
include($page);
?>
    
</body>
</html>

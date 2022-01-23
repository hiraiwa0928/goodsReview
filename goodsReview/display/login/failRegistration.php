<?php
    session_start();
    if (isset($_SESSION['username'])){
        header('Location: display/topPage/topPage.php');
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
</head>
<body>
    <div class="header">
        <div id="title" style="font-size: 40px">登録画面</div>
    </div>
    <div class="main">
        <strong>登録に失敗しました</strong><br><br>
        <a href="./registerMember.php">新規登録画面へ</a>
    </div>
</body>
</html>
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
        <div id="title" style="font-size: 40px">登録完了画面</div>
    </div>
    <div class="main">
        <strong>登録が完了しました</strong><br><br>
        <a href="./login.php">ログイン画面へ</a>
    </div>
</body>
</html>
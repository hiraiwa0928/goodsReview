<?php
    session_start();
    if (isset($_SESSION['username'])){
        header('Location: ../../index.php');
    }

    $backPage = "";
    if(isset($_GET['back'])){
        $backPage = $_GET['back'];
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <script src="../designFolder/login.js"></script>
</head>
<body>
    <div class="header">
        <div id="title" style="font-size: 40px; float: left">ログイン画面</div>
        <a style="font-size: 20px; float: right; padding: 10px;" href="../../index.php">TOPページ</a>
    </div>
    <form method="post" action="../../processing/authentication.php">
        ユーザー名: <input name="username" type="text" minlength=3 maxlength=25 required><br><br>
        パスワード: <input name="password" type="password" minlength=8 maxlength=128 required><br><br>
        <input type="submit" value="ログイン">
        <input name="back" type="hidden" value=<?=$backPage?>>
    </form>
    <br>
    <a href="./registerMember.php">新規登録の方はこちら</a>
</body>
</html>
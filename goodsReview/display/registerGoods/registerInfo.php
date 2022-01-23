<?php
    session_start();
    if(!isset($_SESSION['registerGoods'])){
        header('Location: ../goodsList/goodsList.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録画面</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
</head>
<body>
    <div class="header">
        <div style="font-size: 40px; float: left">商品登録画面</div>
    </div>
    <div class="main">
        <form method="post" action="./checkInfo.php" enctype="multipart/form-data">
            商品名: <input name="goodsName" type="text" minlength=1 maxlength=50 required><br><br>
            画像: <input name="uploadfile" type="file" accept=".jpeg, .jpg, .png" required><br><br>
            概要: <br>
            <textarea name="overview" placeholder="5文字以上400文字以下" cols="50" rows="8" minlength=5 maxlength=400 required></textarea><br><br>
            <input type="submit" value="確 認" style="float: left">
        </form>
        <button style="margin-left: 40px" onclick="location.href='../goodsList/goodsList.php'">戻 る</button>
    </div>
</body>
</html>
<?php
    session_start();
    if(!isset($_SESSION['registerGoods'])){
        header('Location: ../goodsList/goodsList.php');
    }

    // 投稿された画像のパスを指定
    function makeRandStr(){
        $str = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
        $r_str = "";
        for($i = 0; $i < 10; $i++){
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
    
    $newFileName = date('YmdHis').'_'.makeRandStr();
    $file_dir = "../originalImages/";
    $file_name = $newFileName.'.'.pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
    $file_path = $file_dir.$file_name;

    if(!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)){
        header('Location: ./registerInfo.php');
    }

    require_once '../../processing/imageResize.php';
    changeSizeImage($file_name);

    $newFile_path = "../changeSizeImages/".$file_name;

    // 投稿されたグッズの名前と概要を編集
    $postName = "";
    $tempData = explode(" ", $_POST["goodsName"]);

    for($i = 0; $i < count($tempData); $i++){
        $postName .= $tempData[$i];
        $postName .= '[space]';
    }

    $postOverview = "";
    $overviewArray = explode("\r\n", $_POST["overview"]);
    
    for($i = 0; $i < count($overviewArray); $i++){
        $tempData = explode(" ", $overviewArray[$i]);
        for($j = 0; $j < count($tempData); $j++){
            $postOverview .= $tempData[$j].'[space]';
        }
        $postOverview .= '[indention]';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
</head>
<body>
    <div class="header">
        <div style="font-size: 40px; float: left">確認画面</div>
    </div>
    <div class="main">
        商品名: <strong><?=htmlspecialchars($_POST['goodsName'], ENT_QUOTES)?></strong><br><br>
        <div style="overflow: hidden;">
            <div id="imgArea" style="float: left; padding-right: 30px">
                画像:<br>
                <img src=<?=$newFile_path?> width=200 height=200><br><br>
            </div>
            <div id="overviewArea">
                概要:<br>
                <textarea disabled readonly style="resize: none; user-select: none; color: black;" cols="50" rows="8"><?=htmlspecialchars($_POST['overview'], ENT_QUOTES)?></textarea>
            </div>
        </div>

        <form method="post" action="../../processing/addGoods.php" enctype="multipart/form-data">
            <input name="goodsName" type="hidden" value=<?=htmlspecialchars($postName, ENT_QUOTES)?>>
            <input name="goodsImgPath" type="hidden" value=<?=$newFile_path?>>
            <input name="overview" type="hidden" value=<?=htmlspecialchars($postOverview, ENT_QUOTES)?>>
            <input type="submit" value="登 録" style="float: left">
        </form>
        <button style="margin-left: 40px" onclick="location.href='./registerInfo.php'">やり直す</button>
    </div>
</body>
</html>
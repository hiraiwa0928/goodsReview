<?php
    session_start();

    if(!isset($_SESSION['category']) && !isset($_SESSION['name'])){
        header('Location: ../../index.php');
        exit;
    }

    require_once '../../processing/dbConnect.php';
    $pdo = db_connect();

    $data = [];

    try{
        $sql = <<<EOS
            SELECT id, goodsName, imagePath, modified 
            FROM goods
            WHERE category = :category
            ORDER BY modified DESC
        EOS;
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':category', $_SESSION['category'], PDO::PARAM_STR);
        $stmh->execute();

        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
            $subDate = [];
            foreach($row as $key => $value){
                if($key == 'goodsName'){
                    $value = str_replace('[space]', ' ', $value);
                    $value = mb_strimwidth($value, 0, 30, "...");
                }
                $subDate[$key] = htmlspecialchars($value, ENT_QUOTES);
            }
            array_push($data, $subDate);
        }

    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;
    
    $json_array = json_encode($data);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['name']?>リスト</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">

    <script type="text/javascript">
        // グッズ情報を出力
        function showGoodsList(obj){
            htmlStr = "";
            for(var i = 0; i < obj.length; i++){
                htmlStr += "<li style='list-style: none; display: inline-block; padding: 10px 23px; margin: 2px; background-color: #CCFFFF'>\
                            <div style='text-align: center;'><a href='../../processing/createSession.php?id=" + obj[i]['id'] +"'>\
                            <img src='" + obj[i]['imagePath'] + "' width=200px height=200px style='text-align: center;'></a></div>\
                            <strong><div style='font-size:15px; text-align: center;'>" + obj[i]['goodsName'] +"</div></strong>\
                            <div style='font-size:15px; text-align: center;'>更新日: "+ obj[i]['modified'] +"</div></li>";
            }
            document.getElementById('goodsListArea').innerHTML = htmlStr;
        }
        window.onload = function(){
            // データベースから取得したデータ
            const obj = <?php echo $json_array; ?>;
            showGoodsList(obj);
        };
    </script>

</head>
<body>
    <div class="header">
        <img src="../defaultImg/logo.png" style="float: left; padding-top: 12px; padding-right: 10px" width="84px" height="64px">
        <div id="title" style="font-size: 60px; float: left;"><?=$_SESSION['name']?></div>
        <a style="font-size: 20px; float: right; padding: 5px" href="../../index.php">TOP<br>ページへ</a>
        <a style="font-size: 20px; float: right; padding: 5px" href="../../processing/createSession.php">商品を<br>登録する</a>
    </div><br>
    <div class="main">
        <ul id="goodsListArea" style="float: left">

        </ul>
    </div>
</body>
</html>
<?php
    session_start();

    if(!(isset($_SESSION['category']) && isset($_SESSION['name']) && isset($_SESSION['id']))){
        header('Location: ../../index.php');
        exit;
    }

    require_once '../../processing/dbConnect.php';
    $pdo = db_connect();

    $goodsData = [];
    $reviewData = [];

    try{
        // グッズ商品を取得
        $sql1 = <<<EOS
            SELECT goodsName, imagePath, evaluationTotal, overview
            FROM goods
            WHERE id = :id
        EOS;
        $stmh = $pdo->prepare($sql1);
        $stmh->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmh->execute();

        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
            foreach($row as $key => $value){
                if($key == 'overview'){
                    $value = str_replace('[space]', ' ', $value);
                    $overviewData = "";
                    $tmpData = explode("[indention]", $value);
                    for($i = 0; $i < count($tmpData); $i++){
                        $overviewData .= htmlspecialchars($tmpData[$i], ENT_QUOTES);
                        if($i != count($tmpData)-1) $overviewData .= "<br>";
                    }
                    $value = preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', '<a href="\\1\\2" style="word-break: break-all" target="_blank">\\1\\2</a>', $overviewData);
                }
                if($key == 'goodsName'){
                    $value = str_replace('[space]', ' ', $value);
                }
                $goodsData[$key] = $value;
            }
        }

        // レビュー情報を取得
        $sql2= <<<EOS
            SELECT username, evaluation, comment, postedDate
            FROM goodsReview
            WHERE goodsId = :id
            ORDER BY postedDate DESC
        EOS;
        $stmh = $pdo->prepare($sql2);
        $stmh->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmh->execute();
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
            $subData = [];
            foreach($row as $key => $value){
                if($key == 'comment'){
                    $value = str_replace('[space]', ' ', $value);
                    $commentData = "";
                    $tmpData = explode("[indention]", $value);
                    for($i = 0; $i < count($tmpData); $i++){
                        $commentData .= htmlspecialchars($tmpData[$i], ENT_QUOTES);
                        if($i != count($tmpData)-1) $commentData .= "<br>";
                    }
                    $value = preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', '<a href="\\1\\2" style="word-break: break-all" target="_blank">\\1\\2</a>', $commentData);
                }
                $subData[$key] = $value;
            }
            array_push($reviewData, $subData);
        }
    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;

    $json_array = json_encode($reviewData);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レビュー画面</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <script>
        // 星の画像をid=starAreaに挿入する
        function createStarImg(size, num1, num2){
            var starArea =  document.getElementById('starArea');
            for(var i = num1; i < num2; i++){
                var newElementImg = document.createElement('img');
                newElementImg.setAttribute('src', '../starImg/star_' + size +'0.png');
                newElementImg.setAttribute('width', '60px');
                newElementImg.setAttribute('height', '60px');
                starArea.appendChild(newElementImg);
            }
        }
        // 星の画像を出力する処理を行う
        function showEvaluation(eval){

            if(String(eval).length == 1) eval +=　'.0';

            var integer = String(eval).split(".")[0];
            var decimal = String(eval).split(".")[1].split("")[0];
            
            createStarImg(10, 0, integer);
            if(integer != 5){
                var size = "";
                if(decimal == 1 || decimal == 2) size = 2;
                if(decimal == 3 || decimal == 4) size = 4;
                if(decimal == 5) size = 5;
                if(decimal == 6 || decimal == 7) size = 6;
                if(decimal == 8 || decimal == 9) size = 8;
                createStarImg(size, 0, 1);
            }
            createStarImg("", parseInt(integer, 10) + 1, 5);
        }
        // レビューを表示する
        function showReview(goodsReview){
            var reviewArea = document.getElementById('reviewArea');
            var htmlStr = "";

            for(var i = 0; i < goodsReview.length; i++){
                htmlStr += '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; width: 850px">\
                            '+ goodsReview[i]['username'] +'さん<br>\
                            '+ goodsReview[i]['postedDate'] +'<br>\
                            <div style="float: left">評価:</div> ';
                for(var j = 0; j < goodsReview[i]['evaluation']; j++){
                    htmlStr += '<img src="../starImg/star_100.png" width="60px" height="60px">';
                }
                for(var k = goodsReview[i]['evaluation']; k < 5; k++){
                    htmlStr += '<img src="../starImg/star_0.png" width="60px" height="60px">';
                }
                htmlStr += '<hr>コメント:<br>'+ goodsReview[i]['comment'] +'</div><br>';
            }
            reviewArea.innerHTML = htmlStr;
        }

        window.onload = function(){
            var eval = <?php echo $goodsData['evaluationTotal']; ?>;
            showEvaluation(eval);
            const goodsReview = <?php echo $json_array; ?>;
            showReview(goodsReview);
        }
    </script>
</head>
<body>
    <div class="header">
    <img src="../defaultImg/logo.png" style="float: left; padding-top: 12px; padding-right: 10px" width="84px" height="64px">
        <div id="title" style="font-size: 60px; float: left;"><?=$_SESSION['name']?></div>
        <a style="font-size: 20px; float: right; padding: 5px" href="../goodsList/goodsList.php"><?=$_SESSION['name']?><br>リスト</a>
        <a style="font-size: 20px; float: right; padding: 5px" href="../../index.php">TOP<br>ページへ</a>
    </div>
    <div class="main">
        <div id="goodsInfo" style="overflow: hidden;">
            <div style="padding: 70px 30px 30px 30px; float: left; width: 300px; height: 300px">
                <img src="<?=$goodsData['imagePath']?>">
            </div>
            <div style="float: left; width: 600px; height: 300px">
                <div style="padding-top: 70px; float: left;">
                    <div style="font-size: 20px; float: left; height: 80px">
                        <strong>商品名:　</strong>
                    </div>
                    <div style="font-size: 20px; width: 600px">
                        <strong><?=$goodsData['goodsName']?></strong>
                    </div>
                </div>
                <br>
                <strong><div style="font-size: 20px; padding-top: 10px">評価:
                <?php
                    $eval = $goodsData['evaluationTotal'];
                    if(mb_strlen($eval) == 1){
                        $eval .= '.00';
                    }else if(mb_strlen($eval) == 3){
                        $eval .= '0';
                    }

                    if($goodsData['evaluationTotal'] == '0.00'){
                        print 'なし';
                    }else{
                        print substr($eval, 0, 4);
                    }
                ?>
                </div></strong>
                <div id="starArea">
                
                </div>
                <div>
                    <strong><div style="font-size: 20px; padding-top: 10px">概要: </div></strong>
                    <div class="box"><?=$goodsData['overview']?></div>
                </div>
            </div>
        </div>
        <br>
        <hr width="850px" style="float:left"><br>
        <button style="width:600px; height:50px; margin-left:100px" onclick="location.href='../../processing/createSession.php'">レビューを投稿する</button>
        <br><br>
        <div id="reviewArea">
                
        </div>
    </div>
</body>
</html>
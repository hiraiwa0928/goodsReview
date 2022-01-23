<?php
    session_start();

    if(!isset($_SESSION['registerReview'])){
        header('Location: ../review/showReview.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['name']?>リスト</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <script>
        function changeStar(num){
            var starArea = document.getElementById('starArea');

            for(var i = 0; i < num; i++){
                const img = starArea.children[i];
                img.src = "../starImg/star_100.png";
            }

            for(var i = num; i < 5; i++){
                const img = starArea.children[i];
                img.src = "../starImg/star_0.png";
            }
            
            document.getElementById('postData').children[2].value = num;
        }
        window.onload = function(){


            document.getElementById('star1').onclick = function(){
                changeStar(1);
            };
            document.getElementById('star2').onclick = function(){
                changeStar(2);
            };
            document.getElementById('star3').onclick = function(){
                changeStar(3);
            };
            document.getElementById('star4').onclick = function(){
                changeStar(4);
            };
            document.getElementById('star5').onclick = function(){
                changeStar(5);
            };
        }
        function toReviewPage(id){
            window.location.href = "../review/showReview.php?id=" + id;
        }
    </script>
</head>
<body>
    <div class="header">
        <div style="font-size: 40px; float: left;">レビュー登録画面</div>
    </div>
    <div class="main">
        <div style="float: left; padding: 18px 0px 0px 0px">評価: </div>
        <div id="starArea">
            <img src="../starImg/star_100.png" id="star1" width=60px height=60px>
            <img src="../starImg/star_100.png" id="star2" width=60px height=60px>
            <img src="../starImg/star_100.png" id="star3" width=60px height=60px>
            <img src="../starImg/star_0.png" id="star4" width=60px height=60px>
            <img src="../starImg/star_0.png" id="star5" width=60px height=60px>
        </div>
        <form id="postData" method="post" action="./checkInfo.php">
            コメント:<br>
            <textarea name="comment"　placeholder="5文字以上400文字以下" cols="50" rows="8" minlength=5 maxlength=400 required></textarea>
            <input name="evaluation" type="hidden" value=3>
            <br><br>
            <input type="submit" value="確 認" style="float: left">
        </form>
        <button style="margin-left: 40px" onclick="location.href='../review/showReview.php'">戻 る</button>
    </div>
</body>
</html>
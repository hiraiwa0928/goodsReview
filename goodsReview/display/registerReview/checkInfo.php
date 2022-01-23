<?php
    session_start();

    if(!isset($_SESSION['registerReview'])){
        header('Location: ../review/showReview.php');
        exit;
    }
    $postComment = "";
    $commentArray = explode("\r\n", $_POST["comment"]);
    
    for($i = 0; $i < count($commentArray); $i++){
        $tempData = explode(" ", $commentArray[$i]);
        for($j = 0; $j < count($tempData); $j++){
            $postComment .= $tempData[$j].'[space]';
        }
        $postComment .= '[indention]';
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <script>
        function showEvaluation(num){
            var starArea = document.getElementById('starArea');

            for(var i = 0; i < num; i++){
                var newElementImg = document.createElement('img');
                newElementImg.setAttribute('src', '../starImg/star_100.png');
                newElementImg.setAttribute('width', '60px');
                newElementImg.setAttribute('height', '60px');
                starArea.appendChild(newElementImg);
            }
            for(var i = num; i < 5; i++){
                var newElementImg = document.createElement('img');
                newElementImg.setAttribute('src', '../starImg/star_0.png');
                newElementImg.setAttribute('width', '60px');
                newElementImg.setAttribute('height', '60px');
                starArea.appendChild(newElementImg);
            }
        }
        function setPostData(num){
            var postData = document.getElementById('postData');

            var newElementInput = document.createElement('input');
            newElementInput.setAttribute('type', 'hidden');
            newElementInput.setAttribute('name', 'evaluation');
            newElementInput.setAttribute('value', num);

            postData.appendChild(newElementInput);
        }
        window.onload = function(){
            const eval = <?php echo($_POST['evaluation'])?>;
            showEvaluation(eval);
            setPostData(eval);
        }
    </script>
</head>
<body>
    <div class="header">
        <div style="font-size: 40px; float: left">確認画面</div>
    </div>
    <div class="main">
        <div style="float: left; padding: 18px 0px 0px 0px">評価: </div>
        <div id="starArea">

        </div>
        <textarea disabled readonly style="resize: none; user-select: none; color: black;" cols="50" rows="8"><?=htmlspecialchars($_POST['comment'], ENT_QUOTES)?></textarea>
        <form id="postData" method="post" action="../../processing/addReview.php">
            <input name="comment" type="hidden" value=<?=htmlspecialchars($postComment, ENT_QUOTES)?>><br>
            <input type="submit" value="登 録" style="float: left">
        </form>
        <button style="margin-left: 40px" onclick="location.href='./registerInfo.php'">やり直す</button>
    </div>
</body>
</html>
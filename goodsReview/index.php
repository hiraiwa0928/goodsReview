<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>goodsReview</title>
    <link rel="stylesheet" type="text/css" href="./display/stylesheet.css">
    <script src="./display/jsDesign/design.js"></script>
</head>
<body>
    <div class="header">
        <img src="./display/defaultImg/logo.png" style="float: left; padding-top: 12px; padding-right: 10px" width="84px" height="64px">
        <div id="title" style="font-size: 60px; float: left;">Goods Review</div>
        <?php
            if(isset($_SESSION['username'])){
                print '<a style="font-size: 20px; float: right; padding: 10px;" href="./processing/sessionDestroy.php">ログアウト</a>';
                print '<div style="font-size: 20px; float: right; padding: 10px;">ようこそ<strong>'.$_SESSION['username'].'</strong>さん</div>';
            }else{
                print '<a style="font-size: 20px; float: right; padding: 10px;" href="./display/login/registerMember.php">新規会員登録</a>';
                print'<a style="font-size: 20px; float: right; padding: 10px;" href="./display/login/login.php">ログイン</a>';
            }
        ?>
    </div>
    <div class="main">
        <div class="goods">
            <div class="goods_1">
                <ul>
                    <li>
                        <div class="dailyNecessities">
                            <a href="./processing/createSession.php?category=dailyNecessities&name=日用品">
                            <img src="./display/defaultImg/tissue.png" width="400px" height="400px"></a>
                            <p><div style="font-size:30px; text-align: center;"><strong>日用品</strong></div></p>
                        </div>
                    </li>
                    <li>
                        <div class="fashion">
                            <a href="./processing/createSession.php?category=fashion&name=ファッション">
                            <img src="./display/defaultImg/clothes.png" width="400px" height="400px"></a>
                            <p><div style="font-size:30px; text-align: center;"><strong>ファッション</strong></div></p>
                        </div>
                    </li>
                    <li>
                        <div class="appliances">
                            <a href="./processing/createSession.php?category=appliances&name=家電製品">
                            <img src="./display/defaultImg/tv.png" width="400px" height="400px"></a>
                            <p><div style="font-size:30px; text-align: center;"><strong>家電製品</strong></div></p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="goods_2">
                
            </div>
        </div>
    </div>
</body>
</html>
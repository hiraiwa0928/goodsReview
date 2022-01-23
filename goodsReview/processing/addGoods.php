<?php
    session_start();
    require_once './dbConnect.php';

    $pdo = db_connect();

    try{
        $sql = <<<EOS
            INSERT INTO goods(
                category,
                goodsName,
                imagePath,
                addUsername,
                evaluationTotal,
                overview,
                commentNum
            )
            VALUES(
                :category,
                :goodsName,
                :imagePath,
                :addUsername,
                0,
                :overview,
                0
            )
        EOS;
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':category', $_SESSION['category'], PDO::PARAM_STR);
        $stmh->bindValue(':goodsName', $_POST['goodsName'], PDO::PARAM_STR);
        $stmh->bindValue(':imagePath', $_POST['goodsImgPath'], PDO::PARAM_STR);
        $stmh->bindValue(':addUsername', $_SESSION['username'], PDO::PARAM_STR);
        $stmh->bindValue(':overview', $_POST['overview'], PDO::PARAM_STR);
        $stmh->execute();
    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;

    unset($_SESSION['registerGoods']);
    header('Location: ../display/goodsList/goodsList.php');
?>
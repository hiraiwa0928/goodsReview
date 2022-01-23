<?php
    session_start();
    if(!isset($_SESSION['registerReview'])){
        header('Location: ../display/review/showReview.php');
    }

    require_once './dbConnect.php';
    $pdo = db_connect();

    print htmlspecialchars($_POST['comment'], ENT_QUOTES);

    try{
        // レビューを追加
        $sql1 = <<<EOS
            INSERT INTO goodsReview(
                goodsId,
                username,
                evaluation,
                comment
            )VALUES(
                :goodsId,
                :username,
                :evaluation,
                :comment
            )
        EOS;
        $stmh = $pdo->prepare($sql1);
        $stmh->bindValue(':goodsId', $_SESSION['id'], PDO::PARAM_INT);
        $stmh->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmh->bindValue(':evaluation', $_POST['evaluation'], PDO::PARAM_INT);
        $stmh->bindValue(':comment', $_POST['comment'], PDO::PARAM_STR);
        $stmh->execute();
        
        // 更新前のgoods情報を取得
        $sql2 = <<<EOS
            SELECT evaluationTotal, commentNum
            FROM goods
            WHERE id = :id
        EOS;
        $stmh = $pdo->prepare($sql2);
        $stmh->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmh->execute();

        $data = [];
        
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
            foreach($row as $key => $value){
                $data[$key] = $value;
            }
        }

        $newEvaluation = (((double)$data['evaluationTotal'] * $data['commentNum']) + $_POST['evaluation']) / ($data['commentNum'] + 1);

        // goods情報を更新
        $sql3 = <<<EOS
            UPDATE goods
            SET
            evaluationTotal = :evaluationTotal,
            commentNum = :commentNum
            WHERE id = :id
        EOS;
        $stmh = $pdo->prepare($sql3);
        $stmh->bindValue(':evaluationTotal', $newEvaluation, PDO::PARAM_STR);
        $stmh->bindValue(':commentNum', ($data['commentNum'] + 1), PDO::PARAM_INT);
        $stmh->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmh->execute();

    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;

    unset($_SESSION['registerReview']);
    header('Location: ../display/review/showReview.php');
?>
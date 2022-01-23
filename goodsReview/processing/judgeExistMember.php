<?php
    require_once './dbConnect.php';
    $pdo = db_connect();

    $inputText = $_POST['inputText'];

    try{
        $sql = <<<EOS
            SELECT * FROM member
            WHERE username = :username
        EOS;
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':username', $inputText, PDO::PARAM_STR);
        $stmh->execute();
        $count=$stmh->rowCount();
    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }

    $pdo = null;

    $result = null;

    if($count < 1){
        $result = 1;
    }else{
        $result = 0;
    }

    echo $result;
?>
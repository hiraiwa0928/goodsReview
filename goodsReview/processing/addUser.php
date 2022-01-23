<?php
    require_once './dbConnect.php';

    $pdo = db_connect();

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
    $password_confirm = htmlspecialchars($_POST['password_confirm'], ENT_QUOTES);

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

    if($password != $password_confirm || $count > 0){
        header('Location: ../display/login/failRegistration.php');
        exit;
    }

    try{
        $sql = <<<EOS
            INSERT INTO member(
                username,
                password
            )
            VALUES(
                :username,
                :password
            )
        EOS;
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':username', $username, PDO::PARAM_STR);
        $stmh->bindValue(':password', hash('sha256', $password), PDO::PARAM_STR);
        $stmh->execute();
        
    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;
    
    header('Location: ../display/login/complatedRegistration.php');
?>
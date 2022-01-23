<?php
    session_start();
    require_once './dbConnect.php';

    $pdo = db_connect();

    $password = "";

    try{
        $sql = <<<EOS
            SELECT * FROM member
            WHERE username = :username
        EOS;
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $stmh->execute();
        while($result = $stmh->fetch(PDO::FETCH_ASSOC)){
            $password = $result['password'];
        }
    }catch(PDOException $Exception){
        print "エラー:".$Exception->getMessage();
    }
    $pdo = null;

    $inputUsername = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $inputPassword = htmlspecialchars($_POST['password'], ENT_QUOTES);

    if(!$password == "" && $password == hash('sha256', $inputPassword)){
        $_SESSION['username'] = $inputUsername;

        if(isset($_POST['back']) && $_POST['back'] == 'registerGoods'){
            $_SESSION['registerGoods'] = true;
            header('Location: ../display/registerGoods/registerInfo.php');
            exit;
        }else if(isset($_POST['back']) && $_POST['back'] == 'registerReview'){
            $_SESSION['registerReview'] = true;
            header('Location: ../display/registerReview/registerInfo.php');
            exit;
        }
        header('Location: ../index.php');
    }else{
        header('Location: ../display/login/login.php');
    }
?>

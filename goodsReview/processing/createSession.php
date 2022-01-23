<?php
    session_start();

    // 遷移元のファイル名を取得
    $motourl = $_SERVER['HTTP_REFERER'];
    $transitionFileURL = explode("/", $motourl);
    $transitionFile = $transitionFileURL[count($transitionFileURL) - 1];

    if(($transitionFile == "index.php" || $transitionFile == "" || $transitionFile == "localhost")
        && (isset($_GET['category']) && isset($_GET['name']))){
        $_SESSION['category'] = $_GET['category'];
        $_SESSION['name'] = $_GET['name'];
        header('Location: ../display/goodsList/goodsList.php');
        exit;

    }else if($transitionFile == "goodsList.php"){
        // グッズレビュー画面に遷移
        if (isset($_GET['id'])){
            $_SESSION['id'] = $_GET['id'];
            header('Location: ../display/review/showReview.php');
            exit;
        }
        // グッズ登録画面に遷移
        
        // ログインしていない場合
        if(!isset($_SESSION['username'])){
            header('Location: ../display/login/login.php?back=registerGoods');
            exit;
        }
        // ログインしてある場合
        $_SESSION['registerGoods'] = true;
        header('Location: ../display/registerGoods/registerInfo.php');
        exit;

    }else if($transitionFile == "showReview.php"){
        // ログインしていない場合
        if(!isset($_SESSION['username'])){
            header('Location: ../display/login/login.php?back=registerReview');
            exit;
        }
        // ログインしてある場合
        $_SESSION['registerReview'] = true;
        header('Location: ../display/registerReview/registerInfo.php');
        exit;

    }else{
        header('Location: ../index.php');
    }
?>
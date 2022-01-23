<?php
    session_start();

    // 遷移元のファイル名を取得
    $motourl = $_SERVER['HTTP_REFERER'];
    $transitionFileURL = explode("/", $motourl);
    $transitionFile = $transitionFileURL[count($transitionFileURL) - 1];

    if($transitionFile == "index.php" || $transitionFile == "" || $transitionFile == "localhost"){
        unset($_SESSION['username']);
        header('Location: ../index.php');
    }
?>
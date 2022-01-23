<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        usernameJudge = false;
        passwordJudge = false;

        function judgeExitMember(){
            var username = document.getElementById("username").value;
            var msgArea1 = document.getElementById('msgArea1');
            var registerButton = document.getElementById("registerButton");

            if(username.length >= 3){
                $.ajax({
                type: 'post',
                url: "../../processing/judgeExistMember.php",
                data:{
                    "inputText": username
                },
                success: function(result){
                    if(result == 1){
                        usernameJudge = true;
                        msgArea1.innerHTML = "<font color='green'>使用可能なユーザー名です</font>";
                    }else{
                        usernameJudge = false;
                        registerButton.disabled = true;
                        msgArea1.innerHTML = "<font color='red'>そのユーザー名は既に使われています</font>";
                    }
                }
            });
            }else{
                usernameJudge = false;
                registerButton.disabled = true;
                msgArea1.innerHTML = "";
            }
            matchPassword();
        }

        function matchPassword(){
            var password = document.getElementById("password").value
            var password_confirm = document.getElementById("password_confirm").value;
            var msgArea2 = document.getElementById("msgArea2");
            var registerButton = document.getElementById("registerButton");
            if(password.length < 8 || password_confirm.length < 8){
                passwordJudge = false;
                registerButton.disabled = true;
                msgArea2.innerHTML = "";
            }else{
                if(password == password_confirm){
                passwordJudge = true;
                msgArea2.innerHTML = "";
                }else{
                    passwordJudge = false;
                    registerButton.disabled = true;
                    msgArea2.innerHTML = "<font color='red'>パスワードが不一致です</font>";
                }
            }
            judgeRegisterButton();
        }

        function judgeRegisterButton(){
            var registerButton = document.getElementById("registerButton");
            if(usernameJudge && passwordJudge){
                registerButton.disabled = false;
            }else{
                registerButton.disabled = true;
            }
        }

        setInterval("judgeExitMember()", 1000);
    </script>
</head>
<body>
    <div class="header">
        <div id="title" style="font-size: 40px; float: left">新規登録画面</div>
        <a style="font-size: 20px; float: right; padding: 10px;" href="../../index.php">TOPページ</a>
    </div>
    <form method="post" action="../../processing/addUser.php">
        ユーザー名: <input id="username" name="username" type="text" minlength=3 maxlength=25 required>
        <span id="msgArea1">

        </span><br><br>
        パスワード: <input id="password" name="password" type="password" minlength=8 maxlength=128 required><br><br>
        パスワード(確認): <input id="password_confirm" name="password_confirm" type="password" type="text" minlength=8 maxlength=128 required>
        <span id="msgArea2">

        </span><br><br>
        <input id="registerButton" type="submit" value="登 録" disabled>
    </form>
    ＊ ユーザー名は3文字以上25文字以下<br>
    ＊ パスワードは8文字以上128文字以下で設定してください
</body>
</html>
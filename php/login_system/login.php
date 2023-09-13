<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>ログインページ</title>
</head>

<body>
<div class="txt_anime">
  <p>
    <?php
    if (isset($_GET['login'])) {
        echo 'ログインしてください。';
    } else {
        echo '';
    }
    if (isset($_GET['logout'])) {
        echo 'ログアウトしました。';
    } else {
        echo '';
    }
    if (isset($_GET['NOTLOGIN'])) {
        echo 'ログインに失敗しました。ユーザー名またはパスワードが正しくありません。';
    } else {
        echo '';
    }
    if(isset($_GET['completion'])){
        echo 'passwordを変更しました。';
    }
    ?>
    </p>
</div>
    <div class=form>
        <div class="login_form_top">
            <h1>LOGIN</h1>
            <p>Username、Passwordをご入力の上、<wbr>「LOGIN」ボタンをクリックしてください。</p>
        </div>
        <form action="output-login.php" method="post" id="login_form">
            <input type="text" name="login" autocomplete="off" placeholder="Username">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <button type="submit" id="login-button">login</button>
        </form>
    </div>
</body>

</html>
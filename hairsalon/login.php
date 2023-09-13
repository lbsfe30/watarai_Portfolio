<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/view.css">
    <meta name="robots">
    <title>login</title>
</head>

<?php
session_start();

// フォームからのPOSTリクエストを処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーからの入力を取得
    $enteredUsername = htmlspecialchars($_POST['login']);
    $enteredPassword = htmlspecialchars($_POST['password']);
    require 'DB.php';
    // プリペアドステートメントを使用してSQLインジェクション対策
    $sql = $pdo->prepare('SELECT * FROM users WHERE login = ?');
    //sql実行準備
    $sql->execute([$enteredUsername]);
    $userData = $sql->fetch();
    // ユーザーが存在し、かつパスワードが一致した場合にログイン処理
    // echo　password_hash("$enteredPassword", PASSWORD_DEFAULT);
    if ($userData && password_verify($enteredPassword, $userData['password'])) {
        //入力のパスとdb内のハッシュ化されたパスがあってるのか
        $_SESSION['user'] = $userData;
        //ここでDBないをすべて取得したのを変数へ
        header('Location:upload-view.php');
    } else {
        header('Location:login.php?NOTLOGIN');
        exit();
    }
}

?>

<body>
    <form action="" method="post" id="login_form">
        <input type="text" name="login" autocomplete="off" placeholder="Username">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        <button type="submit" id="login-button">login</button>
        <p><a href="index.php">前に戻る</a></p>
        <?php
        if (isset($_GET['NOTLOGIN'])) {
            echo 'ログインに失敗しました。ユーザー名またはパスワードが正しくありません。';
        } else {
            echo '';
        }
        ?>
    </form>


</body>

</html>
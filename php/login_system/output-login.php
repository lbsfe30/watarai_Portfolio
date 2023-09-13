<?php
session_start();

// フォームからのPOSTリクエストを処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーからの入力を取得
    $enteredUsername = htmlspecialchars($_POST['login']);
    $enteredPassword = htmlspecialchars($_POST['password']);
    require '../login_system/DetaBesu.php';
    // プリペアドステートメントを使用してSQLインジェクション対策
    $sql = $pdo->prepare('SELECT * FROM customer WHERE login = ?');
    //sql実行準備
    $sql->execute([$enteredUsername]);
    $userData = $sql->fetch();
    // ユーザーが存在し、かつパスワードが一致した場合にログイン処理
    // echo　password_hash("$enteredPassword", PASSWORD_DEFAULT);
    if ($userData && password_verify($enteredPassword, $userData['password'])) {
        //入力のパスとdb内のハッシュ化されたパスがあってるのか

        $_SESSION['customer'] = $userData;
        //ここでDBないをすべて取得したのを変数へ

        header('Location:../view-list_system/index.php');
    } else {
        header('Location:login.php?NOTLOGIN');
        exit();
    }
}

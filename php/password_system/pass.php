<?php
session_start();

if (isset($_SESSION['customer'])) {
    $_SESSION['customer'];
} else {
    header('Location:../login_system/login.php?login=1');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>パスワード変更</title>
</head>

<body>
    <div class="txt_anime">
        <p>
            <?php
            echo '';
            if (isset($_SESSION['error_messages']['pass'])) {
                echo $_SESSION['error_messages']['pass'];
                unset($_SESSION['error_messages']['pass']); // メッセージを表示したら削除
            }
            echo '';
            if (isset($_SESSION['error_messages']['pass_new'])) {
                echo $_SESSION['error_messages']['pass_new'];
                unset($_SESSION['error_messages']['pass_new']); // メッセージを表示したら削除
            }
            echo '';
            if (isset($_SESSION['error_messages']['pass_new'])) {
                echo $_SESSION['error_messages']['pass_new'];
                unset($_SESSION['error_messages']['pass_new']); // メッセージを表示したら削除
            }
            echo '';
            if (isset($_SESSION['error_messages']['pass_check'])) {
                echo $_SESSION['error_messages']['pass_check'];
                unset($_SESSION['error_messages']['pass_check']); // メッセージを表示したら削除
            }
            ?>
        </p>
    </div>
    <div class="form">
        <div class="pass_form_top">
            <h1>パスワード 変更</h1>
            <p>現在のパスワード、新しいパスワード、確認用をご入力の上、<wbr>「変更」ボタンをクリックしてください。</p>
        </div>
        <form action="pass-output.php" method="post" id="pass_form">
            <input type="password" id="current_password" name="current_password" placeholder=" 現在のパスワード">
            <br>
            <input type="password" id="new_password" name="new_password" placeholder="新しいパスワード">
            <br>
            <input type="password" id="check-new_password" name="check-new_password" placeholder="確認用">
            <br>
            <input type="submit" value="変更" id="submit">
        </form>
        <div class="link">
            <p><a href="../view-list_system/index.php">前に戻る</a></p>
        </div>
    </div>
</body>

</html>
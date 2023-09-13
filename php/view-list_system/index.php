<?php
session_start();

if (isset($_SESSION['customer'])) {
    $_SESSION['customer'];
    //ここ
} else {

    header('Location:../login_system/login.php?login=1');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>view-list</title>
</head>

<body>
    
    <section class="menu">
        <h1>MENU</h1>
        <div class="txt_anime">
        <p>
            <?php
            echo 'ログインありがとうございます。' . $_SESSION['customer']['customer_name'] . '様。ゆっくりしていってね！';
            ?>
            <?php
            if (isset($_GET['completion'])) {
                echo 'パスワード変更を完了しました。';
            } else {
                echo '';
            }
            unset($_GET['completion']);
            ?></p>
    </div>
        <div class="link">
            <ul>
                <li><a href="../scoring_system/scoring.php">採点ぺージ</a></li>
                <li><a href="../chat_system/chat.php">チャット</a></li>
                <li><a href="../password_system/pass.php">パスワード変更</a></li>
                <li><a href="../logout_system/logout.php">ログアウト</a></li>
            </ul>
        </div>
    </section>


</body>

</html>
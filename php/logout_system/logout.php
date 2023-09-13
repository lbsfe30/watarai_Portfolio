<?php
session_start();

if (isset($_SESSION['customer'])) {
    echo '';
} else {
    header('Location:../login_system/login.php');
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>ログアウト</title>
</head>

<body>
    <div class="logout link">
        <h3>ログアウトしますか？</h3>
        <a href="../logout_system/logout-output.php">ログアウト</a>
        <br>
        <p><a href="../view-list_system/index.php">前に戻る</a></p>
    </div>
</body>

</html>
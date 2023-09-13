<!DOCTYPE html>
<html lang="ja">
    <?php
session_start();

if (isset($_SESSION['user'])) {
    echo '';
} else {
    header('Location:login.php?login');
}

// データ消す
require 'DB.php';
// チャットテーブルのレコード数を取得
$countID = $pdo->query("SELECT COUNT(*) FROM `caontact`");
$totalRows = $countID->fetchColumn();
if ($totalRows >= 50) {
    $excessRows = $totalRows - 50;

    for ($i = 0; $i < $excessRows; $i++) {
        // 最も古いレコードを取得（例: プライマリキーが `id` の場合）
        $countID  = $pdo->query("SELECT MIN(`id`) FROM `caontact`");
        $oldestId = $countID->fetchColumn();
        // 古いレコードを削除
        $pdo->query("DELETE FROM `caontact` WHERE `id` = $oldestId");
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/view.css">
    <meta name="robots">
    <title>アップロード</title>
</head>

<body>
    <h2>アップロードするファイルを選択してください。<br><span>※横向きの写真のみアップロード可能です。</span></h2>
    <form action="photograph/upload-output.php" method="post" enctype="multipart/form-data">
        <p><input type="file" name="file"></p>
        <p><input type="submit" value="アップロード"></p>
    </form>
    <?php
    require_once 'DB.php';
    foreach ($pdo->query('select * from product') as $row) {
        echo '<div class="images"><a href="photograph/delete-output.php?id=' . $row['id'] . '">
        <img src="photograph/upload/' . $row['images'] . '" alt="" width="100px">削除</a></div>';
        echo "\n";
    }
    ?>
    <h2>お問い合わせ内容<br><span>※100件以降は自動削除。</span></h2>
    
    <?php
    require_once 'DB.php';
    $sql = $pdo->prepare('SELECT * FROM caontact');
    $sql->execute();
    $caontact = $sql->fetchAll(PDO::FETCH_ASSOC);
    //print_r( $caontact );
    foreach ($caontact as $ALL) {
        echo '<br>' . '名前:' . $ALL['name'] . '　　' . 'メールアドレス:' . $ALL['email'] . '<br>' . '備考:' . $ALL['meg'] . '<br><hr>';
    }
    ?>
    <p><a href="index.php">前に戻る</a></p>
</body>

</html>
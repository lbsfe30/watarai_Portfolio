<?php
session_start();

if (isset($_SESSION['customer'])) {
} else {
    header('Location:../login_system/login.php?login=1');
    exit;
}

date_default_timezone_set('Asia/Tokyo');
$postDate = date('Y-m-d H:i:s');
// 顧客名をセッションから取得
$customer_name = $_SESSION['customer']['customer_name'];

// データ消す
require '../login_system/DetaBesu.php';
// チャットテーブルのレコード数を取得
$countID = $pdo->query("SELECT COUNT(*) FROM `chat`");
$totalRows = $countID->fetchColumn();
// レコード数が300を超える場合、古いメッセージを削除
if ($totalRows >= 300) {
    $excessRows = $totalRows - 300;

    for ($i = 0; $i < $excessRows; $i++) {
        // 最も古いレコードを取得（例: プライマリキーが `id` の場合）
        $countID  = $pdo->query("SELECT MIN(`chat_id`) FROM `chat`");
        $oldestId = $countID->fetchColumn();
        // 古いレコードを削除
        $pdo->query("DELETE FROM `chat` WHERE `chat_id` = $oldestId");
    }
}

// ランダムなバイト列を16進数に変換したトークン
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // echo $_POST['chat_csrf_token'];
    // echo '<br>';
    // echo $_SESSION['chat_csrf_token'];
    if (isset($_POST['chat_csrf_token']) && $_POST['chat_csrf_token'] === $_SESSION['chat_csrf_token']) {
        // トークンが正しい場合の処理
        // テキストエリアの値を取得
        $comment = trim($_POST['textarea']); // 前後の空白をトリム
        // テキストが空でない場合のみデータベースに挿入
        if (!empty($comment)) {
            $stmt = $pdo->prepare("INSERT INTO chat (chat_name,comment, postDate) VALUES (:chat_name,:comment, :postDate)");
            $stmt->bindParam(':chat_name', $customer_name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);
            $stmt->execute();
            unset($_SESSION['chat_csrf_token']); // 一度使ったトークンを無効化
        } else {
            header('Location:chat.php');
        }
    } else {
        header('Location:chat.php');
    }
}
$token = bin2hex(random_bytes(32));
$_SESSION['chat_csrf_token'] = $token;

// ユーザーからの入力を取得
require '../login_system/DetaBesu.php';
// プリペアドステートメントを使用してSQLインジェクション対策
$sql = $pdo->prepare('SELECT * FROM chat');
//sql実行準備
$sql->execute();
$userChat = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['chat'] = $userChat;
// print_r($_SESSION['chat']);

require '../login_system/DetaBesu.php';
// プリペアドステートメントを使用してSQLインジェクション対策
$sql = $pdo->prepare('SELECT * FROM customer');
//sql実行準備
$sql->execute();
$userData = $sql->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/chat.css">
    <title>チャット</title>
</head>

<body>
    <section class="content">
        <div>
            <h1>CHAT</h1>
            <p>ご入力の上、「送信」ボタンをクリックしてください。</p>
        </div>
        <?php foreach ($userChat as $var) : ?>
            <div class="id">
                <?php echo $var['chat_name']; ?>
            </div>
            <div>
                　<?php echo $var['comment']; ?>
            </div>
            <div class="time">
                <time><?php echo $var['postDate']; ?></time>
            </div>
            <hr>
        <?php endforeach; ?>
        <form action="chat.php" method="post" id="chat">
            <input type="hidden" name="chat_csrf_token" value="<?php echo $token; ?>"><br>
            <textarea name="textarea" cols="30" rows="10"></textarea><br>
            <input type="submit" name="submit" value="送信" id="submit">
        </form>
        <p class="link"><a href="../view-list_system/index.php">前に戻る</p>
    </section>
</body>

</html>
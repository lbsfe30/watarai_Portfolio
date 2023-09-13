<?php
session_start();
// フォームから値が入力された場合
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームの入力値を代入
    $pass = htmlspecialchars($_POST['current_password']);
    $pass_new =  htmlspecialchars($_POST['new_password']);
    $pass_check =  htmlspecialchars($_POST['check-new_password']);

    // ログインユーザーのパスワードを取得
    require '../login_system/DetaBesu.php';
    $sql = 'SELECT password FROM customer WHERE customer_id = :customer_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':customer_id', $_SESSION['customer']['customer_id'], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    /* バリデーション */
    // パスワードが一致するかチェック
    if (!password_verify($pass, $result['password'])) {
        $_SESSION['error_messages']['pass'] = '※パスワードが違います。　　';
        header('Location: pass.php');
    }
     // 新パスワードが形式通りかチェック
     if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $pass_new)) {
        $_SESSION['error_messages']['pass_new']= '※パスワードは半角英数字8文字以上で、英大文字、英子文字、数字を最低1個以上含む必要があります。　　';
        header('Location: pass.php');
    }

    // 確認用パスワードが一致するかチェック
    if ($pass_new !== $pass_check) {
       $_SESSION['error_messages']['pass_check'] = '※確認用パスワードが一致しません。　　';
       header('Location: pass.php');
    }

    // バリデーションクリア（エラーメッセージなし）の場合
    if (empty($_SESSION['error_messages'])) {
        // パスワードの暗号化
        $hash_pass = password_hash($pass_new, PASSWORD_DEFAULT);

        // パスワードの更新処理を行う
        $sql = 'UPDATE customer SET password = :pass WHERE customer_id = :customer_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':customer_id', $_SESSION['customer']['customer_id'], PDO::PARAM_INT);
        $stmt->bindValue(':pass', $hash_pass, PDO::PARAM_STR);
        $stmt->execute();

        // マイページへリダイレクト
        header('Location: ../login_system/login.php?completion');
        exit;
    }
}
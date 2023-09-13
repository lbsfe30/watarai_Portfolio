
<?php
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if (!file_exists('upload')) {
        mkdir('upload');
    }


    $file='upload/'.basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {


        //DBに接続する
        $pdo = new PDO('mysql:host=localhost;dbname=test_practice;charset=utf8', 'root', '');

        //DBにファイル名をINSERT
        $stmt = $pdo->prepare('INSERT INTO product VALUES (null, ?)');
        $stmt->execute([basename($_FILES['file']['name'])]);

        
        echo $file, 'のアップロードに成功しました。';
        echo '<p><img alt="image" src="', $file, '" width="100px"></p>';
    } else {
        echo 'アップロードに失敗しました。';
    }
} else {
    echo 'ファイルを選択してください。';
}
?>
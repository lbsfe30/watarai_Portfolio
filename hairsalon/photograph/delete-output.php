<?php
require_once '../DB.php';
$sql = $pdo->prepare('delete from product where id=?');
if ($sql->execute([$_REQUEST['id']])) {
   echo '削除に成功しました';
} else {
   echo '削除に失敗しました';
}
?>
<p><a href="../upload-view.php">前に戻る</a></p>

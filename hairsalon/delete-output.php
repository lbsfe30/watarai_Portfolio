<?php
   $pdo = new PDO('mysql:host=localhost;dbname=test_practice;charset=utf8', 'root', '');

   $sql = $pdo->prepare('delete from product where id=?');
   if($sql->execute([$_REQUEST['id']])){
    echo '削除に成功しました';
   }else{
    echo'削除に失敗しました';
   }
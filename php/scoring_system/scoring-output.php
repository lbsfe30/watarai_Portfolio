<?php
require_once '../login_system/DetaBesu.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        //scoring_idと$_POST['customer_name']が同じ　かつ　insert_userと $_SESSION['customer']['customer_id']が同じ
        $isCheck = false;
        foreach ($_SESSION['SCOR_INDI'] as $SCOR) {
            if ($SCOR['scoring_id'] == $_POST['customer_name'] && $SCOR['insert_user'] == $_SESSION['customer']['customer_id']) {
                require_once '../login_system/DetaBesu.php';
                $TextArea = htmlspecialchars($_POST['textArea']);
                $updateStmt = $pdo->prepare("UPDATE scoring SET scoring_individual = :scoring_individual, textArea = :textArea WHERE scoring_id = :scoring_id AND insert_user = :insert_user");
                $updateStmt->bindParam(':scoring_individual', $_POST['scoring_num'], PDO::PARAM_INT);
                $updateStmt->bindParam(':scoring_id', $SCOR['scoring_id'], PDO::PARAM_INT);
                $updateStmt->bindParam(':insert_user', $SCOR['insert_user'], PDO::PARAM_INT);
                $updateStmt->bindParam(':textArea', $TextArea, PDO::PARAM_STR);
                $updateStmt->execute();

                $isCheck = true;
                break;
            }
        }
        if ($isCheck === false) {
            require_once '../login_system/DetaBesu.php';
            $TextArea = htmlspecialchars($_POST['textArea']);
            //name=submitを送りscoring_idにname=customer_nameないの者を取得
            //scoring_individualも同じ
            $sccr = $pdo->prepare("INSERT INTO scoring (scoring_id,scoring_individual,insert_user,textArea) VALUES (:scoring_id,:scoring_individual,:insert_user,:textArea)");
            //$_POST['customer_name']でSELECT内のKEYを取得
            $sccr->bindParam(':scoring_id', $_POST['customer_name'], PDO::PARAM_INT);
            $sccr->bindParam(':scoring_individual', $_POST['scoring_num'], PDO::PARAM_INT);
            $sccr->bindParam(':insert_user', $_SESSION['customer']['customer_id'], PDO::PARAM_INT);
            $sccr->bindParam(':textArea', $TextArea, PDO::PARAM_STR);
            //loginの際のセッションで自分自身のidを取得
            $sccr->execute();
        }
        unset($_SESSION['csrf_token']); // 一度使ったトークンを無効化
    }
}
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;

//select内の名前をセッションにて取得
// require_once '../login_system/DetaBesu.php';
$sql = $pdo->prepare('SELECT customer_name, customer_id FROM customer');
$sql->execute();
$customer_name = $sql->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['customer_name'] = $customer_name;

//合計して投票人数で割ったもの
// require_once '../login_system/DetaBesu.php';
$AVG = $pdo->query("SELECT scoring_id, customer_name, textArea,AVG(scoring_individual) as avg FROM scoring LEFT JOIN customer ON customer.customer_id = scoring.scoring_id GROUP BY scoring_id");
//asで短縮
//↑分からなかったため先生がSQL文をつくりました。  
$AVG_stmt = $AVG->fetchAll(PDO::FETCH_ASSOC);
//小数第1位まで表示
foreach ($AVG_stmt as &$row) {
    $row['avg'] = floor($row['avg']);
}
//print_r($AVG_stmt);
//同じ人に2回以上点数を付けたとき点数のみ更新するためのSQL
$scor_indi = $pdo->query('SELECT * FROM scoring');
$SCOR_INDI = $scor_indi->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['SCOR_INDI'] = $SCOR_INDI;
// echo print_r($SCOR_INDI);


//コメント取得SQL
$AREATEXT = $pdo->query('SELECT customer.customer_name,customer.customer_id,scoring.scoring_id,scoring.textArea FROM customer INNER JOIN scoring ON customer.customer_id = scoring.scoring_id');
$TEXT_stmt = $AREATEXT->fetchAll(PDO::FETCH_ASSOC);
// print_r($TEXT_stmt);

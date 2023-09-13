<!-- 採点用 -->
<?php
session_start();
if (isset($_SESSION['customer'])) {
} else {
    header('Location:../login_system/login.php?login=1');
    exit;
}
require '../scoring_system/scoring-output.php';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/scoring.css">
    <title>採点</title>
</head>

<body>
    <h1 class="collar">得点ページ</h1>
    <header class="header">
        <div class="header__nav nav" id="js-nav">
            <section>
                <!-- 計算結果と順位表示と名前 -->
                <?php
                // for ($i = 0; $i < count($AVG_stmt); $i++) {
                //     echo $AVG_stmt[$i]['customer_name'].$AVG_stmt[$i]['avg'];
                //     echo '<br>';
                // }
                echo "<table>";
                echo "<tr><td>";
                echo "<p>得点</p>";
                echo "</td></tr>";
                foreach ($AVG_stmt as $array) {
                    $truncated_avg = floor($array['avg'] * 100) / 100;
                    echo "
                <tr>
                    <td>{$array['customer_name']}さん</td>
                    <td>{$truncated_avg}点</td>
                </tr>";
                }
                echo "</table>";
                // echo $AVG_stmt[1]['avg'];
                ?>
            </section>
        </div>
        <button class="header__hamburger hamburger" id="js-hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>
    <section class="scoring-flex">
        <div class="text-container">
            <h3 class="">メッセージ（評価や感想）</h3>
            <?php foreach ($TEXT_stmt as $TEXT) : ?>
                <div class="flowing-element">
                    <?php if (!empty($TEXT['textArea'])) : ?>
                        ・<?= $TEXT['customer_name'] ?>さんに向けたメッセージ<br>　<?= $TEXT['textArea'] ?>
                        <hr>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

<br>

        <div class="scoring sticky">
            <h3 class="">記入欄</h3>
            <p class="p">名前、点数をご入力の上、<wbr>「送信」ボタンをクリックしてください。</p>
            <form action="" method="post" id="form-s">
                <select name="customer_name" id="customer_name">
                    <?php foreach ($customer_name as $key => $value) :
                        echo '<option value="' . $value['customer_id'] . '">' . $value['customer_name'] . '</option>';
                    endforeach; ?>
                </select>さんに
                <select name="scoring_num" id="scoring">
                    <?php
                    for ($i = 1; $i <= 100; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>点入れる。
                <section><br>
                    メッセージ（評価や感想）<br>
                    <textarea name="textArea" id="" cols="30" rows="10"></textarea>
                </section>
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                <input type="submit" name="submit" id="submit" value="送信">
            </form>
            <div class="point">
                <h4 class="RED">注意点</h4>
                <p class="RED">・画面に表示されている名前、得点、コメントは、送信ボタンをクリックすると全て更新されるので、変更の際は、注意してください。<br>・得点の算出方法に関しては1人1人の得点を合算し投票した人数で割った値になっています。<br>・得点はハンバーガーメニューから閲覧可能です。</p>
            </div>
            <div class="link">
                <p><a href="../view-list_system/index.php">前に戻る</a></p>
            </div>
        </div>
    </section>

</body>
<script>
    const ham = document.querySelector('#js-hamburger');
    const nav = document.querySelector('#js-nav');

    ham.addEventListener('click', function() {

        ham.classList.toggle('active');
        nav.classList.toggle('active');
    });

    nav.addEventListener('click', function() {

        ham.classList.toggle('active');
        nav.classList.toggle('active');
    });
</script>

</html>
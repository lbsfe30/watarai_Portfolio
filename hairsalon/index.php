<!DOCTYPE html>
<html lang="ja">
<?php
session_start();
require_once 'DB.php';
// ランダムなバイト列を16進数に変換したトークン
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['chat_csrf_token']) && $_POST['chat_csrf_token'] === $_SESSION['chat_csrf_token']) {
        if(!empty($_POST['email'])){
            // フォームデータをhtmlspecialcharsでエスケープ
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $meg = htmlspecialchars($_POST['meg'], ENT_QUOTES, 'UTF-8');

            $stmt = $pdo->prepare("INSERT INTO caontact (name,email,meg) VALUES (:name,:email, :meg)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':meg', $meg, PDO::PARAM_STR);
            $stmt->execute();
            unset($_SESSION['chat_csrf_token']);
        }else{
            // 'email'が空の場合の処理を追加
        }
    } else {
        // CSRFトークンが一致しない場合の処理を追加
    }
}
$token = bin2hex(random_bytes(32));
$_SESSION['chat_csrf_token'] = $token;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <link rel="stylesheet" href="CSS/slick.css">
    <link rel="stylesheet" href="CSS/slick-theme.css">
    <link rel="stylesheet" href="CSS/slick_script.css">
    <link rel="stylesheet" href="CSS/hamburgermenu.css">
    <link rel="icon" href="images/logo_green.png">
    <meta name="robots">
    <title>ホームページ</title>
</head>

<body>
    <header id="header">
        <div class="parallax" id="HOME">
            <div class="logo">
                HAIR<wbr>SALON
            </div>
            <div class="HOME_main for-pc">
                <img src="images/logo_touka.png" alt="logo画像">
                <nav>
                    <ul id="page-link" class="text_collar">
                        <li><a href="#">HOME</a></li>
                        <li><a href="#ABOUT">ABOUT</a></li>
                        <li><a href="#STAFF">STAFF</a></li>
                        <li><a href="#MENU">MENU</a></li>
                        <li><a href="#GALLERY">GALLERY</a></li>
                        <li><a href="#CONTACT">CONTACT</a></li>
                    </ul>
                </nav>
            </div>

            <div class="for-sp">
                <div class="HOME_sub">
                    <button class="header__hamburger hamburger active" id="js-hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="logo_sp">
                    <img src="images/logo_touka.png" alt="logo画像">
                </div>

                <nav class="hum_nav active" id="js-nav">
                    <ul id="page-link" class="text_collar">
                        <li><a href="#HOME" id="js-a">HOME</a></li>
                        <li><a href="#ABOUT" id="js-b">ABOUT</a></li>
                        <li><a href="#STAFF" id="js-c">STAFF</a></li>
                        <li><a href="#MENU" id="js-d">MENU</a></li>
                        <li><a href="#GALLERY" id="js-e">GALLERY</a></li>
                        <li><a href="#CONTACT" id="js-f">CONTACT</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </header>
    <div class="border">
        <section class="content" id="ABOUT">
            <div>
                <h1 class="headline">ABOUT</h1>
            </div>
            <div class="flex_about">
                <img src="images/Entrance.JPG" alt="入り口">
                <p>近隣の方々をメインにひっそりと営業しています。<wbr>
                    テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                    テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                    テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                </p>
            </div>
            <div class="flex_about top_about">
                <div>
                    <p>待合室の近くには、<wbr>雑誌や自作の雑貨を多数展示しています。<wbr>
                        テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                        テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                        テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                    </p>
                </div>
                <img src="images/waitingroom.JPG" alt="待合室">
            </div>
        </section>
    </div>
    <div class="pallax pa1">
    </div>
    <div class="border">
        <section class="content" id="STAFF">
            <div>
                <h1 class="headline">STAFF</h1>
            </div>
            <div class="flex_STAFF">
                <div>
                    <img src="images/logo.png" width="80px">
                    <h3>スタッフ名 □□□□</h3>
                    <p>スタッフの挨拶。テキストテキストテキストテキストテキスト</p>
                    <h3>経歴</h3>
                    <p>専門学校・大学<br>就職先<br>●●●●年 フリーランスとして働く</p>
                </div>
                <div>
                    <img src="images/logo.png" width="80px">
                    <h3>スタッフ名 □□□□</h3>
                    <p>スタッフの挨拶。テキストテキストテキストテキストテキスト</p>
                    <h3>経歴</h3>
                    <p>専門学校・大学<br>就職先<br>●●●●年 フリーランスとして働く</p>
                </div>
                <div>
                    <img src="images/logo.png" width="80px">
                    <h3>スタッフ名 □□□□</h3>
                    <p>スタッフの挨拶。テキストテキストテキストテキストテキスト</p>
                    <h3>経歴</h3>
                    <p>専門学校・大学<br>就職先<br>●●●●年 フリーランスとして働く</h4>
                </div>
                <div>
                    <img src="images/logo.png" width="80px">
                    <h3>スタッフ名 □□□□</h3>
                    <p>スタッフの挨拶。テキストテキストテキストテキストテキスト</p>
                    <h3>経歴</h3>
                    <p>専門学校・大学<br>就職先<br>●●●●年 フリーランスとして働く</h4>
                </div>
            </div>
        </section>
    </div>
    <div class="pallax pa2">
    </div>
    <div class="border">
        <section class="content" id="MENU">
            <div>
                <h1 class="headline">MENU</h1>
            </div>
            <div class="flex_MENU">
                <div>
                    <h2>CUT</h2>
                    <h3>大人...￥2500</h3>
                    <h3>高校生...￥1800</h3>
                    <h3>中学生...￥1800</h3>
                    <h3>小学生以下...￥1300</h3>
                    <h3>シャンプー＆ブロー付き</h3>
                </div>
                <div>
                    <h2>COLOR</h2>
                    <h3>根本1㎝程度...￥4000〜</h3>
                    <h3>毛先まで...￥5000〜</h3>
                </div>
                <div>
                    <h2>PERM</h2>
                    <h3>perm...￥7000〜 ※cut込み</h3>
                    <h3>ポイントperm...￥3500〜</h3>
                </div>
                <div>
                    <h2>縮毛矯正 STRAIGHT</h2>
                    <h3>大人...￥10000 ※cut込み</h3>
                    <h3>学生...￥6000 ※cut込み</h3>
                </div>
            </div>
            <p class="p">※薬剤の使用量により+￥500〜￥1000頂く場合もあります。</p>
        </section>
    </div>
    <div class="pallax pa3">
    </div>
    <div class="border">
        <section class="content" id="GALLERY">
            <div>
                <h1 class="headline">GALLERY</h1>
            </div>
            <!-- DBからファイル名を全権取得する -->

            <div class="slide_div">
                <ul class="slide-items">
                    <?php
                    require_once 'DB.php';
                    foreach ($pdo->query('select * from product') as $row) {
                        echo '<li><img src="photograph/upload/' . $row['images'] . '" alt=""></li>';
                    }
                    ?>
                </ul>
            </div>

        </section>
    </div>
    <div class="pallax pa4">
    </div>
    <div class="border">
        <section class="content" id="CONTACT">
            <div>
                <h1 class="headline">CONTACT</h1>
            </div>
            <div class="CONTACT flex_CONTACT">
                <div>
                    お問い合わせ<br>
                    <?php
                   if (isset($_POST['email'])) {
                    if (!empty($_POST['email'])) {
                        echo '<br>ご質問いただき、ありがとうございます。土日祝日を除く2から3日営業後に、
                            詳細な情報をお送りいたしますので、お待ちいただけますようお願い申し上げます。
                            何か他のご質問があれば、どうぞお気軽にお知らせください。';
                    } else {
                        echo 'メールアドレスの入力をお願いします。';
                    }
                }
                    ?>
                    <p>
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="お名前"><br>
                        <input type="text" name="email" placeholder="メールアドレス"><br>
                        <textarea name="meg" placeholder="備考"  cols="20" rows="5"></textarea><br>
                        <input type="submit" name="submit" value="送信" id="submit"><br>
                        <input type="hidden" name="chat_csrf_token" value="<?php echo $token; ?>">
                    </form>
                    </p>
                </div>
                <p>tel □□□-□□□□-□□□□</p>
                <p class="text"><a href="#">Instagram<img src="images/Instagram.png" width="30px"></a></p>
                ※InstagramのDMからも予約を受け付けています。
                <p>住所 宮崎県宮崎市□□□□□□□□□□□□□□□□</p>
                <p>営業日<wbr>月曜日から土曜日<wbr>（日曜・祝日 定休日）</p>
            </div>
        </section>
    </div>

    <footer id="footer">
        <p>
        <ul id="page-link" class="text_collar">
            <li><a href="#HOME">HOME</a></li>
            <li><a href="#ABOUT">ABOUT</a></li>
            <li><a href="#STAFF">STAFF</a></li>
            <li><a href="#MENU">MENU</a></li>
            <li><a href="#GALLERY">GALLERY</a></li>
            <li><a href="#CONTACT">CONTACT</a></li>
            <li><a href="login.php">管理者用</a></li>
        </ul>
        <p>Copyright (C) All Rights Reserved.</p>
        </p>
    </footer>
    <script src="JS/jquery-3.7.0.min.js"></script>
    <script src="JS/slick.min.js"></script>
    <script src="JS/script.js"></script>
    <script src="JS/ham.js"></script>
</body>

</html>
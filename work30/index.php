<?php
$host = 'mysql34.conoha.ne.jp';
$login_user = 'bcdhm_nagoya_pf0008';
$password = 'r4Lv,Kw~';
$database = 'bcdhm_nagoya_pf0008';
$error_msg = [];
$image_id = '';
$image_name = '';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK30</title>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <h1>画像一覧</h1>


    <div class="images">

        <?php
        // データベースへ接続
        $db = new mysqli($host, $login_user, $password, $database);
        if ($db->connect_error) {
            echo $db->connect_error;
            exit();
        } else {
            $db->set_charset("utf8"); //文字コードをUTF8に設定
        }
        //SELECT文の実行
        $sql = "SELECT image_name,file_name FROM imagepost WHERE public_flg = '1' ORDER BY create_date DESC ";
        if ($result = $db->query($sql)) {
            // 連想配列を取得
            while ($row = $result->fetch_assoc()) {
                echo '<div class="img_caption">';
                echo '<p>' . $row["image_name"] . '</p>';
                echo '<img src="img/' . $row["file_name"] . '">';
                echo '</div>';
            }
            // 結果セットを閉じる
            $result->close();
        }

        $db->close(); // 接続を閉じる
        ?>
        </div>



<a href="posting.php">画像投稿ページへ</a>
</body>

</html>
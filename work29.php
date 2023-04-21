<?php
$host = 'mysql34.conoha.ne.jp';
$login_user = 'bcdhm_nagoya_pf0008';
$password = 'r4Lv,Kw~';
$database = 'bcdhm_nagoya_pf0008';
$error_msg = [];
$product_name;
$price;
$price_val;
?>




<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK29</title>
</head>

<body>

    <form method="post">
        <input type="submit" name="submitbtn" value="21:エシャロットを登録"><br>
        <input type="submit" name="deletebtn" value="21:エシャロットを削除"><br>
    </form>

    <?php



    if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
    

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // (1)登録するデータを用意
            $product_id = 21;
            $product_code = 1021;
            $product_name = "エシャロット";
            $price = 200;
            $category_id = 1;

            // (2)データベースと接続
            $mysqli = new mysqli($host, $login_user, $password, $database);

            if ($mysqli->connect_errno) {
                echo $mysqli->connect_errno . ' : ' . $mysqli->connect_error;
            }

            $mysqli->begin_transaction(); // トランザクション開始
    
            // (3)文字コードを設定
            $mysqli->set_charset("utf8");

            // (4)プリペアドステートメントの用意
            $stmt = $mysqli->prepare('INSERT INTO product (product_id, product_code, product_name, price, category_id) VALUES (?, ?, ?, ?, ?)');

            // (5)登録するデータをセット
            $stmt->bind_param('iisii', $product_id, $product_code, $product_name, $price, $category_id);

            // (6)登録実行
            $stmt->execute();

            //$error_msg[] = '強制的にエラーメッセージを挿入';
    
            //エラーメッセージ格納の有無によりトランザクションの成否を判定
            if (count($error_msg) == 0) {
                echo '更新完了！';
                $mysqli->commit(); // 正常に終了したらコミット
            } else {
                echo '更新が失敗しました。';
                $mysqli->rollback(); // エラーが起きたらロールバック
            }
            // 下記はエラー確認用。エラー確認が必要な際にはコメントを外してください。
            var_dump($error_msg);
        }

        $mysqli->close(); // 接続を閉じる
    

    } else {
    }





    if (isset($_POST['deletebtn']) === true) { //submitbtnが押された場合の分岐
    

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // (1)登録するデータを用意
            $product_id = 21;

            // (2)データベースと接続
            $mysqli = new mysqli($host, $login_user, $password, $database);

            if ($mysqli->connect_errno) {
                echo $mysqli->connect_errno . ' : ' . $mysqli->connect_error;
            }

            $mysqli->begin_transaction(); // トランザクション開始
    
            // (3)文字コードを設定
            $mysqli->set_charset("utf8");

            // (4)プリペアドステートメントの用意
            $stmt = $mysqli->prepare('DELETE FROM product WHERE product_id = ?');

            // (5)削除するidの値をセット
            $stmt->bind_param('i', $product_id);

            // (6)登録実行
            $stmt->execute();

            //$error_msg[] = '強制的にエラーメッセージを挿入';
    
            //エラーメッセージ格納の有無によりトランザクションの成否を判定
            if (count($error_msg) == 0) {
                echo '削除完了！';
                $mysqli->commit(); // 正常に終了したらコミット
            } else {
                echo '削除が失敗しました。';
                $mysqli->rollback(); // エラーが起きたらロールバック
            }
            // 下記はエラー確認用。エラー確認が必要な際にはコメントを外してください。
            var_dump($error_msg);
        }

        $mysqli->close(); // 接続を閉じる
    

    } else {
    }









    ?>


</body>

</html>
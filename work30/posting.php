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
    <h1>画像投稿</h1>

    <?php
    if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
    
        //titleがemptyなら情報不足を表示
        if (empty($_POST['title']) === true) {
            print '<b>入力情報が不足しています</b>';
        } else { //両方入力されている場合
    
            //ファイルが送信されていない場合はエラー
            if (!isset($_FILES['upload_image'])) {
                echo 'ファイルが送信されていません。';
                exit;
            }

            $updir = "./img";
            $tmp_file = @$_FILES['upload_image']['tmp_name'];
            @list($file_name, $file_type) = explode(".", @$_FILES['upload_image']['name']);
            $copy_file = $_POST['title'] . "-" . date("Ymd-H-i-s") . "." . $file_type;
            if (is_uploaded_file($_FILES["upload_image"]["tmp_name"])) {
                if (move_uploaded_file($tmp_file, "$updir/$copy_file")) {
                    chmod("img/" . $_FILES["upload_image"]["name"], 0644);
                } else {
                    echo "ファイルをアップロード出来ませんでした。";
                }
            } else {
                echo "ファイルが選択されていません。";
            }



            $image_name = $_POST['title'];

            // (2)データベースと接続
            $mysqli = new mysqli($host, $login_user, $password, $database);

            if ($mysqli->connect_errno) {
                echo $mysqli->connect_errno . ' : ' . $mysqli->connect_error;
            }

            $mysqli->begin_transaction(); // トランザクション開始
    
            // (3)文字コードを設定
            $mysqli->set_charset("utf8");

            // (4)プリペアドステートメントの用意
            $stmt = $mysqli->prepare('INSERT INTO imagepost (image_name,file_name) VALUES (?,?)');

            // (5)登録するデータをセット
            $stmt->bind_param('ss', $image_name, $copy_file);

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


            $mysqli->close(); // 接続を閉じる
    
            header("Location:./posting.php");
            exit;
        }

    } else {
    }

    ?>

    <form method="post" enctype="multipart/form-data">
        画像名：<input type="text" name="title"><br>

        画像　：<input type="file" name="upload_image"><br>

        <input type="submit" name="submitbtn" value="画像投稿"><br>
    </form>




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
        $sql = "SELECT image_id,image_name,file_name,public_flg FROM imagepost ORDER BY create_date DESC ";
        if ($result = $db->query($sql)) {
            // 連想配列を取得
            while ($row = $result->fetch_assoc()) {
                echo '<div class="img_caption">';
                echo '<p>' . $row["image_name"] . '</p>';
                echo '<img src="img/' . $row["file_name"] . '">';
                if ($row["public_flg"] == 1) { //公開状態の場合
        
                    echo '<input type="submit" name="prvbtn" value="非公開にする">';
                    if (isset($_POST['prvbtn']) === true) { //prvbtnが押された場合の分岐
                        $mysqli = new mysqli($host, $login_user, $password, $database);
                        $update = "UPDATE imagepost SET public_flg = 0 WHERE image_id = 1;";
                        $mysqli->close(); // 接続を閉じる
                        header("Location:./posting.php");
                        exit;

                    } else {
                    }
                } else { //非公開状態の場合
                    echo '<input type="submit" name="openbtn" value="公開にする">';
                    if (isset($_POST['openbtn']) === true) { //openbtnが押された場合の分岐
                        $mysqli = new mysqli($host, $login_user, $password, $database);

                        $update = "UPDATE imagepost SET public_flg = 1 image_id = 1;";
                        $mysqli->close(); // 接続を閉じる
                        header("Location:./posting.php");
                        exit;

                    } else {
                    }
                }

                echo '</div>';
            }
            // 結果セットを閉じる
            $result->close();
        }

        $db->close(); // 接続を閉じる
        


        ?>




        <form method="post" enctype="multipart/form-data">
            <input type="submit" name="prvbtn" value="非公開にする">
        </form>


        <?php
        if (isset($_POST['prvbtn']) === true) { //prvbtnが押された場合の分岐
            $mysqli = new mysqli($host, $login_user, $password, $database);
            $update = "UPDATE imagepost SET public_flg = 1 WHERE image_id = 4";


            




            $mysqli->close(); // 接続を閉じる
            header("Location:./posting.php");
            exit;

        } else {
        }


        ?>











</body>

</html>
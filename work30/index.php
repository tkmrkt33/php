<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK30</title>
</head>

<body>
    <p>画像投稿</p>

    <form method="post" enctype="multipart/form-data">
        画像名：<input type="text" name="title"><br><br>

        画像　：<input type="file" name="upload_image" accept="image/*"><br>

        <input type="submit" name="submitbtn" value="画像投稿"><br>
    </form>


    <?php
    if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
    
        //title,mainどちらかemptyなら情報不足を表示
        if (empty($_POST['title']) === true || empty($_POST['main']) === true) {
            print '<b>入力情報が不足しています</b>';
        } else { //両方入力されている場合
    
            //ファイルが送信されていない場合はエラー
            if (!isset($_FILES['upload_image'])) {
                echo 'ファイルが送信されていません。';
                exit;
            }
            $save = 'img/' . basename($_FILES['upload_image']['name']);



            //ファイルを保存先ディレクトリに移動させる
            if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $save)) {
                echo 'アップロード成功しました。';
            } else {
                echo 'アップロード失敗しました。';
            }

            $title = $_POST['title'];
            $main = $_POST['main'];


            $data = "<li>" . $title . ":" . $main . "<br><img src=" . $save . " width='150px'></li>";
            $submit_file = 'submissions.txt';

            // dataをtxtファイルの先頭に書き込む処理
            $newpost = file_get_contents($submit_file);
            $newpost = $data . $newpost;
            file_put_contents($submit_file, $newpost);
            fclose($fp);

            header("Location:./index.php");
            exit;
        }
    } else {
    }


    ?>


<p>画像一覧</p>


</body>

</html>
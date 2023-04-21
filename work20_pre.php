<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK20</title>
</head>

<body>

    <form method="post" enctype="multipart/form-data">
        <p><input type="file" name="upload_image"></p>
        <input type="submit" name="submitbtn" value="送信"><br>
    </form>



    <?php
    if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
    
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

    } else {
    }
    ?>

    <ul>
        <?php

        print('<img src='.$save.'>');

        ?>
    </ul>

</body>

</html>
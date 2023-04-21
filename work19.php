<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK19</title>
</head>

<body>

    <p>掲示板</p>
    <?php
    if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
    
        //title,mainどちらかemptyなら情報不足を表示
        if (empty($_POST['title']) === true || empty($_POST['main']) === true) {
            print '<b>入力情報が不足しています</b>';
        } else { //両方入力されている場合

            $title = $_POST['title'];
            $main = $_POST['main'];

            $data = "<li>" . $title . ":" . $main . "</li>";
            $submit_file = 'submissions.txt';

            // dataをtxtファイルの先頭に書き込む処理
            $newpost = file_get_contents($submit_file);
            $newpost = $data . $newpost;
            file_put_contents($submit_file, $newpost);

            fclose($fp);

            header("Location:./work19.php");
            exit;
        }
    } else {
    }
    ?>

    <form method="POST">
        タイトル<br>
        <input type="text" name="title"><br>

        書き込み内容<br>
        <input type="text" name="main"><br><br>

        <input type="submit" name="submitbtn" value="送信"><br>
    </form>
    <form method="post" action="image_save.php" enctype="multipart/form-data">
            <p><input type="file" name="upload_image"></p>
            <p><input type="submit" value="送信"></p>
        </form>



    <ul>
        <?php
        $submit_file = 'submissions.txt';
        $fp = fopen($submit_file, 'rb');
        $buffer = fgets($fp);
        print($buffer);
        fclose($fp);
        ?>
    </ul>
</body>

</html>
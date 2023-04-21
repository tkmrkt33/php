<!DOCTYPE html>
<html lang="ja">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>PHYSICS | PHP Online Chat Space</title>
</head>

<body>
    <div class="container">

        <h1 class="logo">PHYSICS</h1>
        <p class=logocaption>PHP-based app:You'll Share Ideas in this Chat Space!</p>
        <form method="POST">
            <p>NAME</p>
            <input type="text" name="name" value="" placeholder="田中太郎">

            <p>MESSAGE</p>
            <input type="text" name="main" value="" placeholder="こんにちは!">

            <input id="submitbtn" type="submit" name="submitbtn" value="POST!"><br>
        </form>



        <?php
        if (isset($_POST['submitbtn']) === true) { //submitbtnが押された場合の分岐
        
            //title,mainどちらかemptyなら情報不足を表示
            if (empty($_POST['main']) === true) {
                print '<br><b>本文を入力してください！</b><br>';
            } else { //本文が入力されている場合

                if (empty($_POST['name']) === true) { //名前が入力されていない場合
                    $name = "名無し";
                } else { //入力されている場合
                    $name = $_POST['name'];
                }

                $main = $_POST['main'];

                $data = "<li><span class='username'>" . $name . "</span>さん<span class='says'>" . $main . "</span></li>";
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




        <ul class="chatspace">
            <?php
            $submit_file = 'submissions.txt';
            $fp = fopen($submit_file, 'rb');
            $buffer = fgets($fp);
            print($buffer);
            fclose($fp);
            ?>
        </ul>






    </div>


</body>

</html>
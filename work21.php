<?php
$check_data = ''; // 初期化
if (isset($_POST['check_data'])) {
    $check_data = htmlspecialchars($_POST['check_data'], ENT_QUOTES, 'UTF-8');
}

$phoneNum = ''; // 初期化
if (isset($_POST['phoneNum'])) {
    $phoneNum = htmlspecialchars($_POST['phoneNum'], ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>WORK21</title>
</head>

<body>
    <form method="post">
        <div>半角英字で入力を行ってください。</div>
        <input type="text" name="check_data" value=<?php echo $check_data ?>>
        <input type="submit" value="送信">
    </form>
    <?php
    if (!preg_match("/^[a-zA-Z]+$/", $check_data) && $check_data !== '') {
        echo "<div>正しい入力形式ではありません。</div>";

    } else {
        if (preg_match("/dc/", $check_data)) {
            echo "<div>ディーキャリアが含まれています。</div>";
        }
        if (preg_match("/end$/", $check_data)) {
            echo "<div>終了です！</div>";
        }
    }
    ?>


    <form method="post">
        <div>携帯電話番号を入力してください。</div>
        <input type="text" name="phoneNum" value=<?php echo $phoneNum ?>>
        <input type="submit" value="送信">
    </form>
    <?php
    if (!preg_match("[0[7-9]0-[0-9]{4}-[0-9]{4}] ", $phoneNum) && $phoneNum !== '') {
        echo "<div>携帯電話番号の形式ではありません</div>";
    }
    ?>
</body>

</html>
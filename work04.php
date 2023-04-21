<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK04</title>
</head>

<body>
    <?php
    $num;
    //加算
    $num = 109439032 + 39443083;

    //剰余
    $num02 = $num % 4934;

    $string = '計算の答えは'.$num02.'です。';
    print $string;
    ?>
</body>

</html>
<?php
$height = 170; //変数$heightを定義し、値を代入
const weight = 60; //定数WEIGHTを定義し、値を代入

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TRY02</title>
</head>

<body>
    <?php

    $height = 155; //変数$heightに値を代入

    
    print '身長 ';
    print $height;
    print 'cm ';
    print '体重 ' . weight . 'kg';
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK12</title>
</head>

<body>
    <?php

    $numbers = array();

    for ($i = 0; $i <= 4; $i++){
        array_push($numbers, rand(1, 100));
        if ($numbers[$i] % 2 == 0) {
            $oddOrEven = '(偶数)'; 
        } else {
            $oddOrEven = '(奇数)'; 
        }
        print '<p>'.$numbers[$i].$oddOrEven.'</p>';
    } 
    ?>
</body>

</html>
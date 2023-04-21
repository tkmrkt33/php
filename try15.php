<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY15</title>
</head>
<body>
    <?php
        // iが1から始まり、10以下の間繰り返し処理を行う
        for ($i = 1; $i <= 100; $i++){


            switch($i){
                case $i % 3 == 0 && $i % 4 == 0 :
                    print 'Fizz Buzz';
                    break;	//switch文の処理を終了する
                case  $i % 3 == 0:
                    print 'Fizz';
                    break; 	//switch文の処理を終了する
                case  $i % 4 == 0:
                    print 'Buzz';
                    break; 	//switch文の処理を終了する
                default:
                    echo $i;
                    break; 	//switch文の処理を終了する
            } 




        } 
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK11</title>
</head>
<body>
    <?php
        // iが1から始まり、10以下の間繰り返し処理を行う
        for ($i = 1; $i <= 100; $i++):
            switch($i){
                case $i % 3 == 0 && $i % 4 == 0 :
                    print '<p>Fizz Buzz</p>';
                    break;	//switch文の処理を終了する
                case  $i % 3 == 0:
                    print '<p>Fizz</p>';
                    break; 	//switch文の処理を終了する
                case  $i % 4 == 0:
                    print '<p>Buzz</p>';
                    break; 	//switch文の処理を終了する
                default:
                    print '<p>' .$i.'</p>';
                    break; 	//switch文の処理を終了する
            } 
        endfor;



        // iが1から始まり、10以下の間繰り返し処理を行う
        for ($l = 1; $l <= 9; $l++):
            for ($r = 1; $r <= 9; $r++):
                print '<p>'.$l.'*'.$r. '='.$l * $r. '</p>'; 
            endfor;
        endfor;


        $star = 1;
        for ($ex = 1; $ex <= 30; $ex++):
            switch($ex % 2 == 0){
                case true :
                        print '<p>!</p>';                     
                    break;	//switch文の処理を終了する

                default:
                echo str_repeat("*",$star);
                $star++;
                    break; 	//switch文の処理を終了する
            } 
        endfor;






    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK12</title>
</head>
<body>
    <?php
        // iが1から始まり、10以下の間繰り返し処理を行う
        $i = 1;
        while($i <= 100){
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
            $i++;
        }



        // iが1から始まり、10以下の間繰り返し処理を行う
        $l = 1;
        while ($l <= 9){
            $r = 1;
            while ($r <= 9){
                print '<p>'.$l.'*'.$r. '='.$l * $r. '</p>'; 
                $r++;
            }
            $l++;
        }


        $star = 1;

        while($ex <= 30){
            switch($ex % 2 == 0){
                case true :
                        print '<p>!</p>';                     
                    break;	//switch文の処理を終了する

                default:
                echo str_repeat("*",$star);
                $star++;
                    break; 	//switch文の処理を終了する
        }
    }





    ?>
</body>
</html>
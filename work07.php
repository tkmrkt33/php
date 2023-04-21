<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK07</title>
</head>
<body>
    <?php $score = rand(0,100); ?>
        <p>$score: <?php echo $score ?></p> 
        
     <?php 
        if ($score % 3 == 0 && $score % 6 == 0) : ?>
            <p>3と6の倍数です</p>
        <?php elseif ($score % 3 == 0 && $score % 6 != 0) : ?>
            <p>3の倍数で、6の倍数ではありません</p>
        <?php else: ?>
            <p>倍数ではありません</p>
        <?php endif; ?>
        


        <?php 
        $random01 = rand(1,10);	
        $random02 = rand(1,10);	
        ?>
        <p>$score: <?php echo $random01.','.$random02 ?></p>
        

        <?php
        if ($random01 % 3 == 0 && $random02 % 3 == 0) :
            $MultipleOf3 = '2つの数字の中には3の倍数が2つ含まれています。'; 
         elseif ($random01 % 3 == 0 || $random02 % 3 == 0) :
            $MultipleOf3 = '2つの数字の中には3の倍数が1つ含まれています。';
         else:
            $MultipleOf3 = '2つの数字の中に3の倍数が含まれていません';
         endif;
         ?>

        <?php 
        if ($random01 > $random02) :
            print '<p>random01 = '.$random01.' random02 = '.$random02.'です。random01の方が大きいです。'.$MultipleOf3.'</p>'; 
        elseif ($random01 < $random02) :
            print '<p>random01 = '.$random01.' random02 = '.$random02.'です。random02の方が大きいです。'.$MultipleOf3.'</p>';
        else :
            print '<p>random01 = '.$random01.' random02 = '.$random02.'です。2つは同じ数です。'.$MultipleOf3.'</p>';
        endif;

           ?>
</body>
</html>
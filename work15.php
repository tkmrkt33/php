<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK15</title>
</head>

<body>
    <?php
    $class01Names = ['tokugawa', 'oda', 'toyotomi', 'takeda'];
    $class02Names = ['minamoto', 'taira', 'sugawara', 'fujiwara'];

    $class01Scores = array();
    $class02Scores = array();
    for ($i = 0; $i <= 3; $i++) {
        array_push($class01Scores, rand(1, 100));
        array_push($class02Scores, rand(1, 100));
    }
    ;

    $class01 = array($class01Names, $class01Scores);
    $class02 = array($class02Names, $class02Scores);
    $school = array($class01, $class02);




    ?>
    <pre>
        <?php
        print_r($school);
        ?>
    </pre>

    <?php
    print '<p>' . $school[0][0][1] . $school[0][1][1] . '</p>';
    print '<p>' . $school[1][0][2] . $school[1][1][2] . '</p>';

    if ($school[0][1][1] > $school[1][1][2]) {
        $scoreComparison = '<p>' . $school[0][0][1] . 'のほうが優秀です</p>';
    } elseif ($school[0][1][1] < $school[1][1][2]) {
        $scoreComparison = '<p>' . $school[1][0][2] . 'のほうが優秀です</p>';
    } else {
        $scoreComparison = '<p>同点です</p>';
    }
    print '<p>' . $scoreComparison . '</p>';



    echo '<p>'.array_sum($school[0][1])/count($school[0][0]).'</p>';
    echo '<p>'.array_sum($school[1][1])/count($school[1][0]).'</p>';

    ?>


</body>

</html>
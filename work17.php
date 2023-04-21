
<?php 
if (isset($_POST['display_text']) && $_POST['display_text'] != "")  


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK17</title>
</head>

<body>
    <div>入力内容の取得</div>
    <form method="post">
        <input type="text" name="display_text">
        <input type="checkbox" name="choise[]" value="選択肢01">選択肢01
        <input type="checkbox" name="choise[]" value="選択肢02">選択肢02
        <input type="checkbox" name="choise[]" value="選択肢03">選択肢03
        <input type="submit" value="送信">
    </form>


    <?php
    if (isset($_POST['display_text']) || $_POST['display_text'] != "") {
        print '入力した内容： ' . $_POST['display_text'];
        echo '<p>選択肢: ';
        foreach ((array)$_POST['choise'] as $value) {
            echo "{$value}, ";
        }
        echo '</p>';

        htmlspecialchars($_POST['display_text'], ENT_QUOTES, 'UTF-8');
    } else {
        print '入力されていません';
    }
    ?>

</body>

</html>



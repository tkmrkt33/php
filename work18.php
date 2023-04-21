<?php
define('MAX', '3'); // 1ページの表示数

$customers = array(
    // 表示データの配列
    array('name' => '佐藤', 'age' => '10'),
    array('name' => '鈴木', 'age' => '15'),
    array('name' => '高橋', 'age' => '20'),
    array('name' => '田中', 'age' => '25'),
    array('name' => '伊藤', 'age' => '30'),
    array('name' => '渡辺', 'age' => '35'),
    array('name' => '山本', 'age' => '40'),
);

$customers_num = count($customers); // トータルデータ件数

$max_page = ceil($customers_num / MAX); // トータルページ数

// データ表示、ページネーションを実装


if (!isset($_GET['page_id'])) { // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
} else {
    $now = $_GET['page_id'];
}

$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($customers, $start_no, MAX, true);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>WORK18</title>
</head>

<body>
    <div>WORK18</div>



    <table border="1">
        <tr>
            <th>名前</th>
            <th>年齢</th>
        </tr>

        <?php

        foreach ($disp_data as $val) { // データ表示
            print '<tr> <td>' . $val['name'] . '</td>';
            print '<td>' . $val['age'] . '</td></tr>';
        }

        ?>


    </table>

    <?php
    for ($i = 1; $i <= $max_page; $i++) { // 最大ページ数分リンクを作成
        if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
            echo $now . '';
        } else {
            echo '<a href=work18.php?page_id=' . $i . '>' . $i . '</a>';
        }
    }
    ?>


</body>

</html>
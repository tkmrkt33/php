<?php
session_start();
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>チケット予約</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container mt-3">
        <!--Mail Form-->
        <?php
        //HTML特殊文字エスケープ関数
        function h($str)
        {
            return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
        }
        //メールヘッダインジェクション対策のための改行削除関数
        function i($str)
        {
            return str_replace(array("\r", "\n"), '', $str);
        }
        //POSTされたデータを各変数に入れる
        $your_name = isset($_POST['your_name']) ? $_POST['your_name'] : NULL;
        $your_email = isset($_POST['your_email']) ? $_POST['your_email'] : NULL;
        $your_event = isset($_POST['your_event']) ? $_POST['your_event'] : NULL;
        $your_quantity = isset($_POST['your_quantity']) ? $_POST['your_quantity'] : NULL;
        $your_inquiry = isset($_POST['your_inquiry']) ? $_POST['your_inquiry'] : NULL;
        //関数適用
        $your_name = h($your_name);
        $your_email = h($your_email);
        $your_email = i($your_email);
        $your_event = h($your_event);
        $your_quantity = h($your_quantity);
        $your_inquiry = h($your_inquiry);
        //送信プログラム
        if ($_SERVER['REQUEST_METHOD'] != 'POST') { //送信ボタンを押して無い場合
            //CSRF（クロスサイトリクエストフォージェリ シーサフ）対策としてユニークな文字列トークンをセッションに格納
            $_SESSION['token'] = uniqid('', true);
        } else { //送信ボタンを押した場合
            $token = $_POST['token']; //送信されたトークンを変数に格納
            if (!(hash_equals($token, $_SESSION['token']) && !empty($token))) { //送信されたトークンがセッションと同じ値か比較して異なる場合
                $sendcheck = "failed";
            } else { //トークンが一致した場合
                // メール設定
                mb_language("ja");
                mb_internal_encoding("UTF-8");
                $to = "stingraybass@live.jp"; //メール送信先、複数の場合はカンマ区切り 
                $subject = '予約フォームより送信されました'; //メール件名
                $from_mail = "nagoya_pf0008@portfolio.dc-itex.com"; // 送信元メールアドレス（迷惑メールと判別されないよう設置サイトと同じドメインのメールアドレスにしてください
                $from_name = mb_encode_mimeheader($your_name); // 送信者名
                $reply_to = $your_email; //返信先
                $cc = ''; //CC送信先があれば入力
                $bcc = ''; //BCC送信先があれば入力
                // メール本文設定
                $message = "予約フォームより送信されました" . "\r\n\r\n";
                $message .= "お名前：" . $your_name . " 様 \r\n";
                $message .= "メールアドレス：" . $your_email . " \r\n";
                $message .= "予約希望公演：" . $your_event . " \r\n";
                $message .= "枚数：" . $your_quantity . "枚 \r\n";
                $message .= "備考：\r\n" . $your_inquiry . " \r\n";
                // メールヘッダ設定
                $header = "Content-Type: text/plain \r\n";
                $header .= "Return-Path: " . $from_mail . " \r\n";
                $header .= "From: " . $from_name . "<" . $from_mail . ">\r\n";
                $header .= "Sender: " . $from_mail . " \r\n";
                $header .= "Reply-To: " . $reply_to . " \r\n";
                if (!empty($cc)) {
                    $header .= "Cc: " . $cc . " \r\n";
                }
                if (!empty($bcc)) {
                    $header .= "Bcc: " . $bcc . " \r\n";
                }
                $header .= "Organization: " . $from_name . " \r\n";
                $header .= "X-Sender: " . $from_mail . " \r\n";
                $header .= "X-Priority: 3 \r\n";
                mb_send_mail($to, $subject, $message, $header);
                $sendcheck = "send";
            }
        }
        ?>


        <?php
        $db = new mysqli('mysql34.conoha.ne.jp', 'bcdhm_nagoya_pf0008', 'r4Lv,Kw~', 'bcdhm_nagoya_pf0008');
        if ($db->connect_error) {
            echo $db->connect_error;
            exit();
        } else {
            $db->set_charset("utf8"); //文字コードをUTF8に設定
        }

        ?>







        <?php if ($sendcheck == 'send') { ?>
            <p class="d-block border border-success p-2">メッセージが送信されました。</p>
            <p class="mx-2"> 内容確認のうえ、改めてこちらからご連絡差しあげますので、今しばらくお待ちください。</p>
        <?php } elseif ($sendcheck == 'failed') { ?>
            <p class="d-block border border-danger p-2">メッセージが送信できませんでした。</p>
            <p class="mx-2"> フォームを複数タブで開いた場合、エラーが発生する可能性があります。
                お手数ですがページを更新した上で再度お試しください。 </p>
        <?php } else { ?>
            <form class="needs-validation h-adr" method="post">
                <div class="mb-3">
                    <label>お名前 ※カタカナフルネーム<span class="text-danger ml-1">(必須)</span></label><br>
                    <input type="text" class="form-control" name="your_name" placeholder="お名前" required>
                </div>
                <div class="mb-3">
                    <label>メールアドレス<span class="text-danger ml-1">(必須)</span></label><br>
                    <input type="email" class="form-control" name="your_email" placeholder="Eメール" required>
                </div>
                <div class="mb-3">
                    <label>日程/会場<span class="text-danger ml-1">(必須)</span></label><br>

                    <select name="your_event" required>
                        <?php
                        date_default_timezone_set('Japan');
                        $today = date('Y-m-d'); //今日の日付を取得してtodayに代入
                        //SELECT文の実行
                        $sql = "SELECT event_date, venue FROM events WHERE event_date > '$today' ORDER BY event_date";
                        if ($result = $db->query($sql)) {
                            // 連想配列を取得
                            foreach ($result as $row) {
                                $dayAndVenue = $row["event_date"].'/'.$row["venue"] ;
                                echo "<option value='.$dayAndVenue.'>".$dayAndVenue . "</option>";
                            }
                            // 結果セットを閉じる
                            $result->close();
                        }

                        $db->close(); // 接続を閉じる
                        ?>
                    </select>

                </div>
                <div class="mb-3">
                    <label>予約枚数<span class="text-danger ml-1">(必須)</span></label><br>
                    <select name="your_quantity" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>備考<span class="text-danger ml-1"></span></label><br>
                    <textarea class="form-control" name="your_inquiry" rows="2"></textarea>
                </div>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                <div>
                    <button type="submit" class="btn btn-primary mb-3">送信</button>
                </div>
            </form>
        <?php } ?>
        <!--//Mail Form-->
    </div>


</body>

</html>
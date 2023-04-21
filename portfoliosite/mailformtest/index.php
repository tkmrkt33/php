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
    <title>Mail form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        $your_inquiry = isset($_POST['your_inquiry']) ? $_POST['your_inquiry'] : NULL;
        //関数適用
        $your_name = h($your_name);
        $your_email = h($your_email);
        $your_email = i($your_email);
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
                $subject = 'メールフォームより送信されました'; //メール件名
                $from_mail = "nagoya_pf0008@portfolio.dc-itex.com"; // 送信元メールアドレス（迷惑メールと判別されないよう設置サイトと同じドメインのメールアドレスにしてください
                $from_name = mb_encode_mimeheader($your_name); // 送信者名
                $reply_to = $your_email; //返信先
                $cc = ''; //CC送信先があれば入力
                $bcc = ''; //BCC送信先があれば入力
// メール本文設定
                $message = "お問い合わせフォームより、下記内容でメッセージが送信されました。" . "\r\n\r\n";
                $message .= "お名前：" . $your_name . " 様 \r\n";
                $message .= "メールアドレス：" . $your_email . " \r\n";
                $message .= "お問い合わせ内容：\r\n" . $your_inquiry . " \r\n";
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
                    <label>お名前<span class="text-danger ml-1">※</span></label>
                    <input type="text" class="form-control" name="your_name" placeholder="お名前" required>
                    <div class="invalid-feedback"> 入力してください </div>
                </div>
                <div class="mb-3">
                    <label>メールアドレス<span class="text-danger ml-1">※</span></label>
                    <input type="email" class="form-control" name="your_email" placeholder="Eメール" required>
                    <div class="invalid-feedback">入力してください</div>
                </div>

                </div>
                <div class="mb-3">
                    <label>お問い合わせ内容<span class="text-danger ml-1">※</span></label>
                    <textarea class="form-control" name="your_inquiry" rows="5" placeholder="お問い合わせ内容" required></textarea>
                    <div class="invalid-feedback">入力してください</div>
                </div>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                <div>
                    <button type="submit" class="btn btn-primary mb-3">送信</button>
                </div>
            </form>
        <?php } ?>
        <!--//Mail Form-->
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script> -->
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
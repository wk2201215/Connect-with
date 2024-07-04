<?php require 'db/db-connect.php'; ?>
<?php require 'default/header.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$mail_address = $_POST['mail_address'];
$title = "メールアドレスの確認";
$message = "アカウント作成の確定をしてください\r\n
https://aso2201215.mods.jp/Connect_with/program/administrator-signup-input.php";
$headers = "From: from@example.com";

$returnMail = 'XXXXXXX@gmail.com';

if(mb_send_mail($mail_address, $title, $message, $headers, '-f'.$returnMail)){
    echo $mail_address.'にメールを送信しました';
    echo "<br>";
    echo "メール送信成功です";
    echo "<br>";
    echo "まだ登録は完了していません";
    echo "<br>";
    echo "1分以内に登録を完了してください";
    echo '</div>';
}else{
    echo '<div class="failure">';
    echo "メール送信失敗です";
    echo '</div>';
}


?>
<form action="signup-input.php" method="get">
<a href="javascript:history.back()">←戻る</a>
        </form>
<?php require 'default/footer.php'; ?>


<form action="mail-out.php" method="post">
	<p>送り先</p><input type="text" name="to">
	<p>件名</p><input type="text" name="title">
    <p>メッセージ</p><textarea name="message" cols="60" rows="10"></textarea>
    <p><input type="submit" name="send" value="送信"></p>
</form>

<?php
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $mail_address = $_POST['mail_address'];
    $title = "メールアドレスの確認";
    $message = $_POST['message'];
    $headers = "From: from@example.com";

    if(mb_send_mail($to, $title, $message, $headers))
    {
        echo "メール送信成功です";
    }
    else
    {
        echo "メール送信失敗です";
    }
?>
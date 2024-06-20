<?php require 'db/db-connect.php'; ?>
<?php
  $pdo=new PDO($connect,USER,PASS);
  $sql=$pdo->prepare('INSERT INTO account_tentative (account_name, account_password, mail_address)
  VALUES (value1, value2, DATE_ADD(NOW(), INTERVAL 1 MINUTE)); -- 例: 7日後に削除');
  $sql->execute([$_POST['account_name'], $_POST['account_password'], $_POST['mail_address'],]);
?>
<?php
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $mail_address = $_POST['mail_address'];
    $title = "メールアドレスの確認";
    $message = "アカウント作成の確定をしてください\r\n
    https://aso2201215.mods.jp/Connect_with/program/signup.php"
    $headers = "From: from@example.com";

    if(mb_send_mail($to, $title, $message, $headers))
    {
        echo "メール送信成功です";
        echo "<br>";
        echo "まだ登録は完了していません"
        echo "<br>";
        echo "1分以内に登録を完了してください";
        
    }
    else
    {
        echo "メール送信失敗です";
    }
?>
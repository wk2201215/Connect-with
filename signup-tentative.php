<?php require 'db/db-connect.php'; ?>
<?php
  $pdo=new PDO($connect,USER,PASS);
  $sql=$pdo->query('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE delete_flag=0 AND reply_id IS NULL');
  
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
        echo "1分以内に確認してください"
        
    }
    else
    {
        echo "メール送信失敗です";
    }
?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);

$sql_check = $pdo->prepare('SELECT * FROM account WHERE mail_address = ? LIMIT 1');
$sql_check->execute([$_POST['mail_address']]);
$resultCount = $sql_check->rowCount();
if($resultCount == 1){
    header('Location: error.php?message=そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。');
    exit();
}

$sql=$pdo->prepare('INSERT INTO account_tentative (account_name, account_password, mail_address, delete_at)
VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 1 MINUTE))'); 
// 1分後に削除
$sql->execute([$_POST['account_name'], $_POST['account_password'], $_POST['mail_address']]);


mb_language("Japanese");
mb_internal_encoding("UTF-8");

$mail_address = $_POST['mail_address'];
$title = "メールアドレスの確認";
$message = "アカウント作成の確定をしてください\r\n
https://aso2201215.mods.jp/Connect_with/program/signup.php";
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
}else{
    echo "メール送信失敗です";
}
?>
<?php require 'default/footer.php'; ?>
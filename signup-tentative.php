<?php require 'db/db-connect.php'; ?>
<?php require 'default/header.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);

$sql_check = $pdo->prepare('SELECT * FROM account WHERE mail_address = ? LIMIT 1');
$sql_check->execute([$_POST['mail_address']]);
$resultCount = $sql_check->rowCount();
if($resultCount == 1){
    echo '<h1 style="font-size: 18px;">そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。</h1>';

    // header('Location: error.php?message=そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。');
    // exit();
}else{
    $pas1 = rand(0, 9);
    $pas2 = rand(0, 9);
    $pas3 = rand(0, 9);
    $pas4 = rand(0, 9);
    $sql=$pdo->prepare('INSERT INTO account_tentative (account_name, account_password, mail_address, delete_at, pas1, pas2, pas3, pas4)
    VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 1 MINUTE), ?,?,?,?)'); 
// 1分後に削除
$sql->execute([$_POST['account_name'], $_POST['account_password'], $_POST['mail_address'],$pas1,$pas2,$pas3,$pas4]);
$inserted_id = $pdo->lastInsertId();

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$mail_address = $_POST['mail_address'];
$title = "メールアドレスの確認";
$message = "アカウント作成の完了をしてください\r\n
新規登録に必要なパスワードは".$pas1.$pas2.$pas3.$pas4."です。\r\n
https://aso2201215.mods.jp/Connect_with/program/signup.php?id=".$inserted_id;
$headers = "From: from@example.com";

$returnMail = 'XXXXXXX@gmail.com';

if(mb_send_mail($mail_address, $title, $message, $headers, '-f'.$returnMail)){
    echo $mail_address.'にメールを送信しました';
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
}


?>
<form action="signup-input.php" method="get">
<a href="javascript:history.back()">←戻る</a>
        </form>
<?php require 'default/footer.php'; ?>

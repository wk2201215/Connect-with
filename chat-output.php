<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
$sql->execute([$_POST['mail_address']]);
$item=$sql->fetch();
if($_POST['to']==='on'){
    $sql_check=$pdo->prepare('SELECT * FROM chatmember INNER JOIN chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = ? LIMIT 1');
    $sql_check->execute([$_SESSION['account']['account_id'],$item['account_id']]);
    $resultCount = $sql_check->rowCount();
    if($resultCount == 0){
        $message='すでに招待しています';
        header('Location:chat-input.php?$message='.$message);
        exit();
    }
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name, number_people, one_on_one) VALUES (?, ?, ?)');
    $sql_input->execute([$item['account_name'],2,$item['account_id']]);
}else{
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name, number_people, one_on_one) VALUES (?, ?, DEFAULT)');
    $sql_input->execute([$item['account_name'],2]);
}

foreach($sql_input as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom  WHERE chatroom_id');
    $sql2->execute([$row['chatroom_id']]);
    $item2->$sql2->fetch();
    // echo $item['chatroom_name'];
}
$member = [
    $_SESSION['account']['account_id'],$item['account_id']
];
//memberテーブル
foreach($member as $row){
    $sql_input2=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id) VALUES (?, ?)');
    $sql_input->execute([$item2['chatroom_id'], $row]);
}
header('Location:chat-top.php');
exit();
?>
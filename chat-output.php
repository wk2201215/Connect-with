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
    if($resultCount == 1){
        $message='すでに招待しています';
        header('Location:chat-input.php?to=1&message='.$message);
        exit();
    }
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, one_on_one) VALUES (?, ?, ?, ?)');
    if($_SESSION['account']['account_id'] < $item['account_id']){
        $sql_input->execute([$_SESSION['account']['account_name'], $item['account_name'], 2, $item['account_id']]);
    }else{
        $sql_input->execute([$item['account_name'], $_SESSION['account']['account_name'], 2, $item['account_id']]);
    }
}else{
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, one_on_one) VALUES (?, ?, ?, DEFAULT)');
    $sql_input->execute([$_POST['chatroom_name'], $_SESSION['account']['account_id'], 2]);
}

$inserted_id = $pdo->lastInsertId();

$member = [
    $_SESSION['account']['account_id'],$item['account_id']
];
//memberテーブル
foreach($member as $row){
    $sql_input2=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id) VALUES (?, ?)');
    $sql_input2->execute([$inserted_id, $row]);
}
header('Location:chat-top.php');
exit();
?>
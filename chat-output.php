<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
foreach($_POST['mail'] as $row){
    $sql=$pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
    $sql->execute([$row]);
    $item=$sql->fetchAll();
}
// $sql=$pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
// $sql->execute([$_POST['mail_address']]);
// $item=$sql->fetch();

if($_POST['to']==='on'){
    $sql_check=$pdo->prepare('SELECT * FROM chatmember INNER JOIN chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = ? LIMIT 1');
    $sql_check->execute([$_SESSION['account']['account_id'],$item[0]['account_id']]);
    $resultCount = $sql_check->rowCount();

    $sql_check2=$pdo->prepare('SELECT * FROM chatmember_invitation INNER JOIN chatroom ON chatmember_invitation.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = ? LIMIT 1');
    $sql_check2->execute([$_SESSION['account']['account_id'],$item[0]['account_id']]);
    $resultCount2 = $sql_check2->rowCount();

    if($resultCount == 1 || $resultCount2 == 1){
        $message='すでに招待しています';
        header('Location:chat-input.php?to=1&message='.$message);
        exit();
    }
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, one_on_one) VALUES (?, ?, ?, ?)');
    if($_SESSION['account']['account_id'] < $item[0]['account_id']){
        $sql_input->execute([$_SESSION['account']['account_name'], $item[0]['account_name'], 2, $_SESSION['account']['account_id']]);
    }else{
        $sql_input->execute([$item[0]['account_name'], $_SESSION['account']['account_name'], 2, $_SESSION['account']['account_id']]);
    }
}else{
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, one_on_one) VALUES (?, ?, ?, DEFAULT)');
    $sql_input->execute([$_POST['chatroom_name'], $_SESSION['account']['account_id'], 2]);
}

$inserted_id = $pdo->lastInsertId();

$sql_input3=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id) VALUES (?, ?)');
$sql_input3->execute([$inserted_id, $_SESSION['account']['account_id']]);

// $member = [
//     $item['account_id']
// ];
//memberテーブル
foreach($item as $row){
    $sql_input2=$pdo->prepare('INSERT INTO chatmember_invitation  (chatroom_id, account_id, invitation_id) VALUES (?, ?, ?)');
    $sql_input2->execute([$inserted_id, $row['account_id'], $_SESSION['account']['account_id']]);
}
header('Location:chat-top.php');
exit();
?>
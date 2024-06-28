<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if($_POST['to']==='on'){
    $sql_check=$pdo->prepare('SELECT * FROM chatmember INNER JOIN chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = 1');
    $sql_check->execute([$_SESSION['account']['account_id']]);
    
}
$sql=$pdo->prepare('SELECT * FROM chatmember WHERE account_id = ?');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom  WHERE chatroom_id');
    $sql2->execute([$row['chatroom_id']]);
    $item->$sql2->fetch();
    echo $item['chatroom_name'];
}
?>
<?php require 'db/db-connect.php'; ?>
<?php
session_start();
$post_id = $_POST['post_id'];
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

$sql=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id, invitation_id) VALUES (?, ?, ?)');
$sql->execute([$_POST['chatroom_id'], $_POST['account_id'], $_POST['invitation_id']]);

$sql2=$pdo->prepare('DELETE FROM chatmember_invitation WHERE chatroom_id = ? AND account_id = ? AND invitation_id = ?');
$sql2->execute([$_POST['chatroom_id'], $_POST['account_id'], $_POST['invitation_id']]);

$messege = $_SESSION['account']['account_name'].'が承諾しました';
$sql_m=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
$sql_m->execute([$_POST['chatroom_id'], $messege, 0]);

$memberList = 'invitation';
//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
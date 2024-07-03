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

$sql=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id) VALUES (?, ?)');
$sql->execute([$_POST['chatroom_id'], $_POST['account_id']]);

$sql2=$pdo->prepare('DELETE FROM chatmember_invitation WHERE chatroom_id = ? AND account_id = ?');
$sql2->execute([$_POST['chatroom_id'], $_POST['account_id']]);

$memberList = 'invitation';
//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

if($_POST['flag'] == 1){
    $sql=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
    $sql->execute([$_POST['chatroom_id'], $_POST['message'], $_SESSION['account']['account_id']]);
}else{
    
}


$memberList = 'chat';
//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
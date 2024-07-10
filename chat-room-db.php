<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
$memberList;
$count = 0;
if($_POST['flag'] == 1){
    $sql=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
    $sql->execute([$_POST['chatroom_id'], $_POST['message'], $_SESSION['account']['account_id']]);
}else{
    $sql=$pdo->prepare('SELECT * FROM chatmessage WHERE chatroom_id = ?');
    $sql->execute([$_POST['chatroom_id']]);
    foreach($sql as $row){
        if($_POST['chatmessage_id'] < $row['chatmessage_id']){
            $memberList[$count] = $row['chat_text'].'_jibunn';
            echo $row['chat_text'];
            echo '_jibunn';
            echo '<br>';
            $count++;
        }
      }
}



//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
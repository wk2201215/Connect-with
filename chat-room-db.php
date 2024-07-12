<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
$memberList[0]['text'] = '通信正常';
$count = 0;
if($_POST['flag'] == 1){
    $sql=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
    $sql->execute([$_POST['chatroom_id'], $_POST['message'], $_SESSION['account']['account_id']]);
}else{
    $sql=$pdo->prepare('SELECT * FROM chatmessage INNER JOIN  account ON chatmessage.account_id = account.account_id INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
    $sql->execute([$_POST['chatroom_id']]);
    foreach($sql as $row){
        if($_POST['chatmessage_id'] < $row['chatmessage_id']){
            $memberList[$count]['text'] = $row['chat_text'];
            if($row['account_id'] == $_SESSION['account']['account_id']){
                $memberList[$count]['flag'] = 'my';
            }else{
                $memberList[$count]['flag'] = 'you';
            }
            $memberList[$count]['photograph_path'] = $row['photograph_path'];
            $memberList[$count]['name'] = $row['account_name'];
            $memberList[$count]['time'] = $row['message_time'];
            $memberList[$count]['message_id'] = $row['chatmessage_id'];
            $count++;
        }
    }
}



//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
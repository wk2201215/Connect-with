<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE chatmember.chatroom_id = ?');
$sql->execute([$_GET['chatroom_id']]);
$item=$sql->fetch();
echo '<div id="container">';

echo 'チャットルーム';
echo 'ルーム名'.$item['chatroom_name1'];
echo '<hr>';
$sql2=$pdo->prepare('SELECT * FROM chatmessage WHERE chatroom_id = ?');
$sql2->execute([$item['chatroom_id']]);
$item2=$sql2->fetchAll();
$item2=end($item2);
echo '<div id="messageTextBox" data-id="'.$item2['chatmessage_id'].'">';
  foreach($sql2 as $row){
    if($item['account_id']== $_SESSION['account']['account_id']){
        echo $row['chat_text'];
        echo '_jibunn';
    }else{
        echo $row['chat_text'];
        echo '_aite';
    }
    echo '<br>';
  }
echo '</div>';
echo '<form method="post" onsubmit="writeMessage(); return false;">';
  echo '<input id="message" name="message" type="text" value="" />';
  echo '<input type="button" value="送信" onclick="writeMessage('.$item['chatroom_id'].')">';
echo '</form>';
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

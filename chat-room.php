<?php session_start(); ?>
<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php'; ?>

<?php
$pdo=new PDO($connect,USER,PASS);
if($_GET['flag'] == 0){
  $sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE chatmember.chatroom_id = ? AND chatmember.account_id = ?');
  $sql->execute([$_GET['chatroom_id'],$_SESSION['account']['account_id']]);
  $item=$sql->fetch();
}else{
  $sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE chatmember.chatroom_id = ? AND chatmember.account_id != ? UNION ALL SELECT * FROM chatmember_invitation INNER JOIN  chatroom ON chatmember_invitation.chatroom_id = chatroom.chatroom_id WHERE chatmember_invitation.chatroom_id = ? AND chatmember_invitation.account_id != ?');
  $sql->execute([$_GET['chatroom_id'],$_SESSION['account']['account_id'],$_GET['chatroom_id'],$_SESSION['account']['account_id']]);
  $item=$sql->fetch();
}

require 'default/header-top-chatroom.php';
require 'default/header-menu-chatroom.php';
echo '<div id="container">';

// echo 'チャットルーム';
// echo 'ルーム名'.$item['chatroom_name1'];
// echo '<hr>';
$sql2=$pdo->prepare('SELECT * FROM chatmessage WHERE chatroom_id = ?');
$sql2->execute([$item['chatroom_id']]);
$item2=$sql2->fetchAll();
$item3=end($item2);
echo '<div id="messageTextBox" data-id="'.$item3['chatmessage_id'].'" data-chatroom_id="'.$item['chatroom_id'].'">';
  $sql3=$pdo->prepare('SELECT * FROM chatmessage INNER JOIN  account ON chatmessage.account_id = account.account_id INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
  $sql3->execute([$item['chatroom_id']]);
  foreach($sql3 as $row){
    echo '<div class="m" id="'.$row['chatmessage_id'].'">';
    if($row['account_id'] == 0){
        echo '<div class="sisutemu">';
          echo '<p>';
          echo $row['chatmessage_time'];
          echo '<br>';
          echo $row['chat_text'];
          echo '</p>';
        echo '</div>';
    }else if($row['account_id'] == $_SESSION['account']['account_id']){
        echo '<div class="my">';
          // echo '<div class="name">';
          //   echo $row['account_name'];
          // echo '</div>';
          echo '<p>';
          echo $row['chat_text'];
          echo '</p>';
          echo '<div class="time">';
            echo $row['chatmessage_time'];
          echo '</div>';
        echo '</div>';
    }else{
        echo '<div class="you">';
          echo '<div class="faceicon">';
            echo '<img src="Image-display.php?hogeA='.$row['photograph_path'].'" alt="ルームアイコン"/>';
          echo '</div>';
          echo '<div class="name">';
            echo $row['account_name'];
          echo '</div>';
          echo '<div class="chatting">';
            echo '<div class="says">';
              echo '<p>';
              echo $row['chat_text'];
              echo '</p>';
            echo '</div>';
          echo '</div>';
          echo '<div class="time">';
            echo $row['chatmessage_time'];
          echo '</div>';
        echo '</div>';
    }
    echo '</div>';
  }
echo '</div>';
// echo '<form method="post" onsubmit="writeMessage(); return false;">';
//   echo '<div id="post">';
//     echo '<input id="message" name="message" type="text" value="" />';
//     echo '<input type="button" value="送信" onclick="writeMessage()">';
//   echo '</div>';
// echo '</form>';
echo '</div>';
?>



<?php require 'default/footer-menu-chat.php'; ?>
<?php require 'default/footer-top-chatroom.php'; ?>

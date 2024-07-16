<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<?php
echo '<div id="container">';
echo 'チャットルーム';
echo '<hr>';
echo '<div id="chatroom_input">';
    echo 'chatroom追加（招待）';
echo '</div>';
echo '<div id="chatroom_invitation">';
    echo '招待された';
echo '</div>';
echo '<hr>';
$pdo=new PDO($connect,USER,PASS);
//個人
echo '個人チャット';
$sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one != 0');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom INNER JOIN photograph ON chatroom.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
    $sql2->execute([$row['chatroom_id']]);
    $item=$sql2->fetch();
    echo '<div class="chatroom" data-id="'.$row['chatroom_id'].'">';
    echo '<img src="Image-display.php?hogeA='.$item['photograph_path'].'" alt="ルームアイコン" class="room-img" />';
    if($item['one_on_one'] != 0){
        if($_SESSION['account']['account_id'] < $item['one_on_one']){
            echo $item['chatroom_name2'];
        }else{
            echo $item['chatroom_name1'];
        }
    }else{
        echo $item['chatroom_name1'];
    }
    echo '</div>';
    echo '<br>';
}
echo '<hr>';
//複数
echo '複数チャット';
$sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = 0');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom INNER JOIN photograph ON chatroom.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
    $sql2->execute([$row['chatroom_id']]);
    $item=$sql2->fetch();
    echo '<div class="chatroom" data-id="'.$row['chatroom_id'].'">';
    echo '<img src="Image-display.php?hogeA='.$item['photograph_path'].'" alt="ルームアイコン" class="room-img" />';
    echo '<div class="roomname">';
    if($item['one_on_one'] != 0){
        if($_SESSION['account']['account_id'] < $item['one_on_one']){
            echo $item['chatroom_name2'];
        }else{
            echo $item['chatroom_name1'];
        }
    }else{
        echo $item['chatroom_name1'];
    }
    echo '</div>';
    echo '</div>';
    echo '<br>';
}
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top-chat.php'; ?>

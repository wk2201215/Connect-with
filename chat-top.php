<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top-chat.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<link rel="stylesheet" href="./css/chat.css">
<?php
$pdo=new PDO($connect,USER,PASS);
$sql_t=$pdo->prepare('SELECT * FROM theme WHERE theme_id = ?');
$sql_t->execute([$_SESSION['account']['theme_id']]);
$item_t = $sql_t->fetch();
echo '<div id="t" data-idb="'.$item_t['body'].'" data-idhf="'.$item_t['header'].'" data-idn="'.$item_t['moji'].'"></div>';
echo '<div id="container">';
echo '<h2>チャットルーム</h2>';
echo '<hr>';
echo '<div id="chatroom_input">';
echo '<button class="addition">';
    echo 'chatroom追加（招待）';
echo '</button>';
echo '</div>';
echo '<div id="chatroom_invitation">';
echo '<button class="invited">';
    echo '招待された';
echo '</button>';
echo '</div>';
echo '<hr>';
//個人
echo '個人チャット';
$sql=$pdo->prepare('SELECT * FROM chatmember INNER JOIN  chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one != 0');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom INNER JOIN photograph ON chatroom.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
    $sql2->execute([$row['chatroom_id']]);
    $item=$sql2->fetch();
    $sql3=$pdo->prepare('SELECT * FROM chatmember WHERE chatroom_id = ? AND account_id != ?');
    $sql3->execute([$row['chatroom_id'], $_SESSION['account']['account_id']]);
    $item3=$sql3->fetch();
    echo '<div class="chatroom" data-id="'.$row['chatroom_id'].'">';
    echo '<img src="Image-display.php?hogeA='.$item['photograph_path'].'" alt="ルームアイコン" class="b room-img" />';
    echo '<div class="b roomname">';
    if($_SESSION['account']['account_id'] < $item3['account_id']){
        echo $item['chatroom_name2'];
    }else{
        echo $item['chatroom_name1'];
    }
    echo '</div>';
      echo '<div class="s">';
        echo ':';
      echo '</div>';
      echo '</div>';
    // echo '<br>';
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
    echo '<img src="Image-display.php?hogeA='.$item['photograph_path'].'" alt="ルームアイコン" class="b room-img" />';
    echo '<div class="b roomname">';
    echo $item['chatroom_name1'];
    echo '</div>';
      echo '<div class="s">';
        echo ':';
      echo '</div>';
    echo '</div>';
    // echo '<br>';
}
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top-chat.php'; ?>

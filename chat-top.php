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
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('SELECT * FROM chatmember WHERE account_id = ?');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom INNER JOIN photograph ON chatroom.photograph_id = photograph.photograph_id WHERE chatroom_id = ?');
    $sql2->execute([$row['chatroom_id']]);
    $item=$sql2->fetch();
    echo '<img src="Image-display.php?hogeA='.$item['photograph_path'].'" alt="ルームアイコン" class="post-img" />';
    if($item['one_on_one'] != 0){
        if($_SESSION['account']['account_id'] < $item['one_on_one']){
            echo $item['chatroom_name2'];
        }else{
            echo $item['chatroom_name1'];
        }
    }else{
        echo $item['chatroom_name1'];
    }
    echo '<br>';
}
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

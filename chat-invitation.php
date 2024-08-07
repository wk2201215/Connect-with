<?php session_start(); ?>
<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top-chat.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<?php
echo '<div id="container">';
echo '招待された';
echo '<hr>';
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('SELECT * FROM chatmember_invitation WHERE account_id = ?');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom  WHERE chatroom_id = ?');
    $sql2->execute([$row['chatroom_id']]);
    $item=$sql2->fetch();

    $sql3=$pdo->prepare('SELECT * FROM chatmember  WHERE chatroom_id = ?');
    $sql3->execute([$row['chatroom_id']]);
    $item2=$sql3->fetch();

    if($item['one_on_one'] != 0){
        if($_SESSION['account']['account_id'] < $item2['account_id']){
            echo $item['chatroom_name2'];
        }else{
            echo $item['chatroom_name1'];
        }
    }else{
        echo $item['chatroom_name1'];
    }
    echo '<button class="consent" data-roomid="'.$row['chatroom_id'].'" data-accountid="'.$row['account_id'].'" data-id="'.$row['invitation_id'].'">承諾</button>';
    echo '<hr>';
}
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top-chat.php'; ?>

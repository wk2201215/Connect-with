<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php
echo '<div id="container">';
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('SELECT * FROM chatmember WHERE account_id = ?');
$sql->execute([$_SESSION['account']['account_id']]);
foreach($sql as $row){
    $sql2=$pdo->prepare('SELECT * FROM chatroom  WHERE chatroom_id');
    $sql2->execute([$row['chatroom_id']]);
    $item->$sql2->fetch();
    echo $item['chatroom_name'];
}
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

<?php require 'db/db-connect.php'; ?>
<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);

echo '<div id="container">';

$post_id=$_GET['post_id'];
$p=$_GET['p'];
if($p=0):
    $sql=$pdo->prepare('SELECT * FROM post WHERE post_id = ?');
else:
    $sql=$pdo->prepare('SELECT * FROM reply WHERE reply_id = ?');
endif;
$sql->execute([$post_id]);
require 'default/post.php';
echo '返信';
$sql=$pdo->prepare('SELECT * FROM reply WHERE post_id = ?');
$sql->execute([$post_id]);
require 'default/post.php';
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

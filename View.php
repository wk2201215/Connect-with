<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<link rel="stylesheet" href="css/view.css">
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
// query
$sql=$pdo->prepare('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE delete_flag=0 AND reply_id IS NULL AND post.category_id=?');
$sql->execute([$_SESSION['account']['category_id']]);
echo '<div id="container">';
require 'default/post.php';
echo '</div>';
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

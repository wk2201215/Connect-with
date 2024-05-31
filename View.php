<?php require 'db/db-connect.php'; ?>
<?php session_start(); ?>
<link rel="stylesheet" href="css/view.css">
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('select * from post');
echo '<div id="container">';
require 'default/post.php';
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

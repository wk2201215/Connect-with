<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);

echo '<div id="container">';

$post_id=$_GET['post_id'];
$sql=$pdo->prepare('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE post_id = ?');
$sql->execute([$post_id]);
require 'default/post.php';

echo '<HR>';
echo '返信';

$sql=$pdo->prepare('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE reply_id = ?');
$sql->execute([$post_id]);
require 'default/post.php';
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

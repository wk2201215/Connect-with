<?php require 'db/db-connect.php'; ?>
<link rel="stylesheet" href="css/view.css">
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE delete_flag=0 AND reply_id IS NULL');
echo '<div id="container">';
require 'default/post.php';
echo '</div>';
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

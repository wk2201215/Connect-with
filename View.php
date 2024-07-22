<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<link rel="stylesheet" href="css/view.css">
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
// echo '<div id="over">';
// echo '↓';
// echo '</div>';
echo '<div class="spinner-overlay" id="spinnerOverlay">';
    echo '<div class="spinner">更新</div>';
echo '</div>';

$pdo=new PDO($connect,USER,PASS);
$sql_t=$pdo->prepare('SELECT * FROM theme WHERE theme_id = ?');
$sql_t->execute([$_SESSION['account']['theme_id']]);
$item_t = $sql_t->fetch();
echo '<div id="t" data-idb="'.$item_t['body'].'" data-idhf="'.$item_t['header'].'" data-idn="'.$item_t['moji'].'"></div>';
// query
$sql=$pdo->prepare('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE delete_flag=0 AND reply_id IS NULL AND post.category_id=? ORDER BY post_id DESC');
$sql->execute([$_SESSION['account']['category_id']]);
echo '<div id="container">';
require 'default/post.php';
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>

<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<?php

echo '<form action="post-delete.php" method="post">';
echo '<input type="text" name="keyword">';
echo '<input type="submit" value="検索">';
?>
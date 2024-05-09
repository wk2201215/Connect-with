<?php session_start(); ?>
<?php require 'default/header.php'; ?>
<?php

echo '<form action="post-delete.php" method="post">';
echo '検索';
echo '<input type="text" name="keyword">';
echo '<input type="submit" value="検索">';

?>


<?php require 'default/footer.php'; ?>

<?php session_start(); ?>
<?php require 'default/header.php'; ?>
<form action="post-delete.php" method="post">
   検索
   <input type="text" name="keyword">
   <input type="submit" value="検索">


<?php require 'default/footer.php'; ?>

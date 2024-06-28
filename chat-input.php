<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<?php
echo '<div id="container">';
if(isset($_GET['']))
echo 'チャットルーム追加(招待)';
echo '<HR>';
echo '<button type="submit" id="to" data>個人</button>';
echo '<HR>';
echo '<form action="chat-output.php" method="post">';
  echo '<input type="text" name="mail_address" required>';
  echo '<input type="radio" name="to" class="to" value="on" required>個人';
  echo '<input type="radio" name="to" class="to" value="multiple" required>複数';
  echo '<button type="submit">招待</button>';
echo '</form>';
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
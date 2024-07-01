<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<?php
echo '<div id="container">';
echo 'チャットルーム追加(招待)';
echo '<HR>';
echo '<form action="chat-output.php" method="post">';
  if($_GET['to']==1){
    echo '<button type="submit" id="to" data-id="2">複数に変更</button>';
    echo '<input type="hidden" name="to" value="1">';
  }else{
    echo '<button type="submit" id="to" data-id="1">個人に変更</button>';
    echo '<input type="hidden" name="to" value="2">';
  }
  echo '<input type="text" name="mail_address" required>';
  echo '<button type="submit">招待</button>';
echo '</form>';
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
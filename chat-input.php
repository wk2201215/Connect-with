<?php session_start(); ?>
<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top-chat.php'; ?>
<?php require 'default/header-menu-chat.php'; ?>
<link rel="stylesheet" href="css/chat-input.css">
<?php
echo '<div id="container">';
echo 'チャットルーム追加(招待)';
echo '<HR>';
echo '<form action="chat-output.php" method="post"  enctype="multipart/form-data">';
  if(isset($_GET['message'])){
    echo $_GET['message'];
  }
  if($_GET['to']==1){
    echo '<button class="input-button" type="submit" id="to" data-id="2">複数に変更</button>';
    echo '<input type="hidden" name="to" value="on">';
  }else{
    echo '<button class="input-button" type="submit" id="to" data-id="1">個人に変更</button>';
    //echo 'ルーム名';
    echo '<br>';
    echo '<input type="text" name="chatroom_name" size="25" placeholder="ルーム名を入力してください。" required>';
    echo '<input type="hidden" name="to" value="two">';
    echo '<div id="pura" class="pura">メンバーを増やす</div>';
    echo '<div id="mai" class="mai">メンバーを減らす</div>';
  }
  echo '<br>';
  echo 'ルーム写真';
  echo '<input type="file" name="image" />';
 // echo '相手のメールアドレス';
  echo '<div class="mail" data-count=1>';
    echo '<div id="1">'; 
      echo '<input type="text" name="mail[]" size="35" placeholder="相手のメールアドレスを入力してください。" required>';
      echo '<br>';
    echo '</div>';
  echo '</div>';
  echo '<button class="input-button" type="submit">招待</button>';
echo '</form>';
echo '</div>';
?>



<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top-chat.php'; ?>
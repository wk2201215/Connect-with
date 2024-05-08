<?php session_start(); ?>
<?php require 'default/header.php'; ?>

    <form action="login-output.php" method="post">
<?php
    unset($_SESSION['account']);


    echo '<label>メールアドレス</label>';
    echo '<input type="text" name="mail-address">';

    echo '<label>パスワード</label>';
    echo '<input type="password" name="password">';
  
    echo '<input type="submit" value="ログイン">';
        
    if(isset($_GET['hogeA'])){
        echo '<p>',$_GET['hogeA'],'</p>';
    }
   
    echo '<label>アカウント新規作成は<a href="account-input.php">こちら</a></label>';
   
?>
    </form>
    <div class="start">
        <p><img src="images/t.jpeg" alt=""></p>
    </div>

  <script src="script/design.js"></script>
<?php require 'default/footer.php'; ?>

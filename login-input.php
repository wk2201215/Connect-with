<?php session_start(); ?>
<?php require 'default/header.php'; ?>

    <form action="login-output.php" method="post">
<?php

    echo '<p style="font-size:100px;">ログイン</p><br>';
    unset($_SESSION['account']);

    echo '<label><p1 style="font-size:50px;">メールアドレス</p1></label><br>';
    echo '<input type="text" name="mail_address" id="mail_address"><br>';

    echo '<label>パスワード</label><br>';
    echo '<input type="password" name="password" id="account_password"><br>';
  
    echo '<input type="submit" value="ログイン"><br>';
        
    if(isset($_GET['hogeA'])){
        echo '<p>',$_GET['hogeA'],'</p>';
    }
    ?>
    </form>
    <form action="signup-input.php" method="post">
    <button type="submit">新規登録</button>
    </form>
   
    
    <div class="start">
        <p><img src="images/t.jpeg" alt=""></p>
    </div>

  <script src="script/design.js"></script>
<?php require 'default/footer.php'; ?>

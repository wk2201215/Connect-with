<?php session_start(); ?>
<?php require 'default/header.php'; ?>

    <form action="sign up-output.php" method="post">
<?php
$name=$address=$password='';
if (isset($_SESSION['account'])){
   $name=$_SESSION['account']['account_name'];
   $address=$_SESSION['account']['mail_address'];
   $password=$_SESSION['account']['account_password'];
}


    echo '<h2>新規登録</h2>';

    echo '<label>名前</label>';
    echo '<input type="text" name="account_name" value="',$name,'">';

    echo '<label>メールアドレス</label>';
    echo '<input type="text" name="mail_address" value="',$address,'">';

    echo '<label>パスワード</label>';
    echo '<input type="password" name="account_password" value="',$password,'">';
  
    echo '<input type="submit" value="新規登録">';
   
?>
</form>

  <script src="script/design.js"></script>
<?php require 'default/footer.php'; ?>
<link rel="stylesheet" href="./css/sign up.css">
<?php session_start(); ?>
<?php require 'default/header.php'; ?>
<form action="signup-output.php" method="post">
<?php
$name = isset($_SESSION['account']['account_name']) ? htmlspecialchars($_SESSION['account']['account_name']) : '';
$address = isset($_SESSION['account']['mail_address']) ? htmlspecialchars($_SESSION['account']['mail_address']) : '';
// パスワードは表示しないことを推奨
$password = '';

echo '<p style="font-size:100px;">新規登録</p><br>';

echo '<label><p1 style="font-size:35px;">名前</p1></label><br>';
echo '<input type="text" name="account_name" value="' . $name . '"><br>';

echo '<label><p1 style="font-size:35px;">メールアドレス</p1></label><br>';
echo '<input type="text" name="mail_address" size="50" value="' . $address . '"><br>';

echo '<label><p1 style="font-size:35px;">パスワード</p1></label><br>';
echo '<input type="password" name="account_password" value="' . $password . '"><br>';

echo '<input type="submit" value="新規登録">';

?>
</form>

<script src="script/design.js"></script>
<?php require 'default/footer.php'; ?>

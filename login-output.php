<?php require 'function/not-access.php'; ?>
<?php session_start(); ?>
<?php require 'db/db-connect.php';?>
<?php
unset($_SESSION['account']);
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from account where mail-address=?');
$sql->execute([$_POST['mail-address']]);
foreach($sql as $row) {
    if(password_verify($_POST['password'],$row['account_password'])){
        $_SESSION['account']=[
            'account_id'=>$row['account_id'],
            'account_mail-address'=>$row['mail-address'],
            'account_password'=>$_POST['account_password'],
            'account_name'=>$row['account_name'],
            'photograph_id'=>$row['photograph_id'],
            'self-introduction'=>$row['self-introduction'],
            'authority'=>$row['authority'],
            'delete_flag'=>$row['delete_flag']
        ];
    }
}
if(isset($_SESSION['account'])){
header('Location:top.php');
exit();    
}else{
header('Location:login-input.php?hogeA=ログイン名またはパスワードが違います');
exit();
}
?>

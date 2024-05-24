<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php';?>
<?php
session_start();
unset($_SESSION['account']);
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from account where mail_address=?');
$sql->execute([$_POST['mail_address']]);
foreach($sql as $row) {
    if(password_verify($_POST['password'],$row['account_password'])){
        $authority = $row['authority'];
        $_SESSION['account']=[
            'account_id'=>$row['account_id'],
            'mail_address'=>$row['mail_address'],
            'account_password'=>$row['account_password'],
            'account_name'=>$row['account_name'],
            'photograph_id'=>$row['photograph_id'],
            'self_introduction'=>$row['self_introduction'],
            'authority'=>$row['authority'],
            'delete_flag'=>$row['delete_flag']
        ];
if($authority == 1){
    $_SESSION['role'] ='user';
}else if($authority == 2){
    $_SESSION['role'] = 'admin';
}
break;

    }
}
if(isset($_SESSION['account'])){
    if($_SESSION['role'] == 'admin'){
    header('Location: admin-dashboard.php');
    }else{
    header('Location:top.php');
    }
exit();    
}else{
header('Location:login-input.php?hogeA=ログイン名またはパスワードが違います');
exit();
}
?>

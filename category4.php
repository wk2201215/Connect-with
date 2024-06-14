<?php require 'db/db-connect.php'; ?>
<?php
session_start();
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('UPDATE account SET category_id = ? WHERE account_id=?');
$sql->execute([$_GET['category_id'],$_SESSION['account']['account_id']]);
$_SESSION['account']['category_id'] = $_GET['category_id'];

$_SESSION['account']['category_name'] = $_GET['category_name'];
header('Location:view.php?');
exit();
?>